<?php
namespace FrontModule\DefaultModule;
use Nette\Mail\Message;

/**
 * Represents the homepage and its sub-pages.
 *
 * @author Patrick Kusebauch
 * @version 3.00, 09. 11. 2014
 */
class HomepagePresenter extends BasePresenter
{
    /** @var \Models\Event */
    protected $events;

    /** @var  \Models\Member */
    protected $members;

    /** @var  \Models\News */
    protected $news;

    /**
     * Injects connection to event model
     *
     * @param \Models\Event $event
     * @throws \Nette\InvalidStateException
     */
    public function injectEvent(\Models\Event $event){
        if ($this->events) {
            throw new \Nette\InvalidStateException('Events has already been set');
        }
        $this->events = $event;
    }

    /**
     * Injects connection to member model
     *
     * @param \Models\Member $member
     * @throws \Nette\InvalidStateException
     */
    public function injectMember(\Models\Member $member){
        if ($this->members) {
            throw new \Nette\InvalidStateException('Member has already been set');
        }
        $this->members = $member;
    }

    /**
     * Injects connection to news model
     *
     * @param \Models\News $news
     * @throws \Nette\InvalidStateException
     */
    public function injectNews(\Models\News $news){
        if ($this->news) {
            throw new \Nette\InvalidStateException('News has already been set');
        }
        $this->news = $news;
    }

    public function startup()
    {
        parent::startup();
        \AntispamControl::register();
    }

    /**
     * Sets variables for view of "Kontakty" page
     */
    public function renderContact()
    {
        $template = $this->template;
        $template->title = 'Kontakty';
        $template->leaders = $this->members->getLeaders();
    }

    /**
	 * Sets variables for view of "Úvod" page
	 */
	public function renderDefault()
	{
		$template = $this->template;
		$template->chronicle = $this->events->getNewestChronicle();
		$template->news = $this->news->getNewest(4);
		$template->leader = $this->members->getLeader();
	}

    /**
     * Sets variables for view of "Přidej se" page
     */
    public function renderJoin()
    {
        $template = $this->template;
        $template->title = 'Nezávazná přihláška';
    }

    /**
     * Sets variables for view of "Klubovna" page
     */
    public function renderLounge()
    {
        $params = $this->context->parameters;
        $template = $this->template;
        $template->title = "Klubovna";
        $template->images = \skauti\Finder::findFiles('*.jpg')
            ->in($params['wwwDir'] . $params['loungePhotosStorage'])
            ->orderByName();
    }

    /**
     * Sets variables for view of "Pro rodiče" page
     */
    public function renderParent()
    {
        $template = $this->template;
        $template->title = 'Pro rodiče';
        $template->mainLeader = $this->members->getLeader();
        $template->leaders = $this->members->getLeaders();
    }

    /**
	 * Sets variables for view of "Nábor" page
	 */
	public function renderRecruit()
	{
		$template = $this->template;
        $template->title = 'Nábor';
		$template->leader = $this->members->getLeader();
	}

    /**
	 * Creates Form for Opting in
     *
	 * @return \Nette\Application\UI\Form
	 */
	protected function createComponentOptInForm()
	{
		$form = new \Nette\Application\UI\Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addAntispam();
		$form->addText('name', 'Jméno a Příjmení:')
			->setRequired('Vložte jméno.');
        $form->addText('mail', 'E-mail:')
			->addRule(\Nette\Application\UI\Form::EMAIL, 'Musí se jednat o platný e-mail.')
        	->setRequired('Vložte e-mail.');
        $form->addText('phone', 'Telefon:')
			->setRequired('Vložte telefonní číslo');
		$form->addText('school', 'Škola:');
		$form->addText('class', 'Třída:');
		$form->addSubmit('send', 'Nezávazně se přihlásit');

        $form->onSuccess[] = $this->optInFormSucceeded;
        return $form;
	}

    /**
	 * Processes Form for Opting in
     *
	 * @param \Nette\Application\UI\Form $form
	 */
	public function optInFormSucceeded(\Nette\Application\UI\Form $form)
	{
     	//Sets the information
		$values = $form->getValues(TRUE);
        try {
    		$message = new Message;
    		$message->addTo($this->context->parameters['contactMail'])
    			->setFrom($values['mail']);

    		//Templating
		    $template = $this->createTemplate();
	    	$template->setFile(__DIR__ . '/../templates/emails/optInTemplate.latte');
    		$template->title = '27skauti.cz - Nezávazná příhláška';
    		$template->values = $values;
            $message->setHtmlBody($template);

		    //Sending
            $mailer = new \Nette\Mail\SendmailMailer();
    		$mailer->send($message);
		    $this->flashMessage('Přihláška byla odeslána');
            $this->redirect('default');
        } catch (\Nette\InvalidStateException $e) {
            $this->flashMessage('Přihlášku se nepodařilo odeslat. Zkuste to prosím později');
        }
	}

    /**
     * Creates component for Secondary menu
     *
     * @param string $name
     */
    protected function createComponentSubmenu($name) {
        $nav = new \Navigation\Navigation($this, $name);
        $nav->setMenuTemplate('submenu.latte');
        $nav->add("Úvod", "Homepage:default");
    //    $nav->add("Nábor", "Homepage:recruit");
        $nav->add("Pro rodiče", "Homepage:parent");
        $nav->add("Klubovna", "Homepage:lounge");
        $nav->add("Kontakty", "Homepage:contact");
        $nav->add("Přidej se", "Homepage:join");
    }
}
