<?php
namespace FrontModule\DefaultModule;

/**
 * The "Kniha návštěv" to add comment about the site and what not
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
class GuestbookPresenter extends BasePresenter
{

    /** @var  \Models\Guestbook */
    protected $guestbook;

    /**
     * Inject connection to guestbook model
     *
     * @param \Models\Guestbook $guestbook
     * @throws \Nette\InvalidStateException
     */
    public function injectGuestbook(\Models\Guestbook $guestbook) {
        if ($this->guestbook) {
            throw new \Nette\InvalidStateException('Guestbook has already been set');
        }
        $this->guestbook = $guestbook;
    }

    public function startup()
    {
	    parent::startup();
	    \AntispamControl::register();
    }

    /**
     * Sets variables for view of "Archive" page
     */
    public function renderArchive()
    {
        $template = $this->template;
        $template->title = "Archiv knihy návštěv";
        $posts = $this->guestbook->getAllViewable();
        $vp = new \VisualPaginator($this, 'vp');
        $page = $vp->page;
        $paginator = $vp->getPaginator();
        $paginator->setItemCount($posts->count());
        $paginator->setItemsPerPage(10);
        $paginator->setPage($page);
        $template->posts = $posts
            ->limit($paginator->getLength(), $paginator->getOffset());
    }

    /**
	 * Sets variables for view of "Default" page
	 */
	public function actionDefault()
	{
	$this->getSession()->start();
        $template = $this->template;
        $template->title = "Kniha návštěv";
		$template->posts = $this->guestbook->getViewableSubset(10);
	}

    /**
     * Creates the GuestBook Form
     *
     * @return \Nette\Application\Ui\Form
     */
    protected function createComponentGuestBookForm()
	{
		$form = new \Nette\Application\Ui\Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
		if (!$this->user->isLoggedIn()) { //some things are pre-filled for logged in users
			$form->addAntispam();
			$form->addText('name', 'Jméno:')
				->setRequired('Vložte jméno.')
				->setAttribute('size', 35);
		}
		$form->addTextarea('post', 'Vzkaz:')
			->setRequired('Nelze přidat prázdný příspěvěk.')
			->setAttribute('cols', 75)
            ->setAttribute('rows', 5);
		if (!$this->user->isLoggedIn()) { //some things are pre-filled for logged in users
			$form->addText('mail', 'Email:')
				->setAttribute('size', 35)
				->addCondition(\Nette\Application\UI\Form::FILLED)
					->addRule(\Nette\Application\UI\Form::EMAIL, 'Musí se jednat o platný e-mail');
		}
		$form->addText('web', 'Web:')
			->setAttribute('size', 35)
			->setOption('description', \Nette\Utils\Html::el('span')->setText('Adresa bez http://'));
		$form->addSubmit('send', 'Odeslat');

        $form->getElementPrototype()->id = "guestbook-form";
		$form->onSuccess[] = $this->guestBookFormSucceeded;
		return $form;
	}

    /**
     * Processes the Guestbook form
     *
     * @param \Nette\Application\Ui\Form $form  Form to be processed
     */
    public function guestBookFormSucceeded(\Nette\Application\Ui\Form $form)
	{
		$values = $form->getValues(TRUE);
		unset($values['send']);
		unset($values['spam']);
		unset($values['form_created']);
		if($this->user->isLoggedIn()) {
			$values['user_id'] = $this->user->id;
		}

		$values['time'] = new \Nette\Utils\DateTime();

		$this->guestbook->insert($values);

		$this->flashMessage('Zpráva byla odeslána');
		$this->redirect('this');
	}

    /**
     * Creates the Submenu
     *
     * @param String $name
     */
    protected function createComponentSubmenu($name) {
        $nav = new \Navigation\Navigation($this, $name);
        $nav->setMenuTemplate('submenu.latte');
        $nav->add("Archiv", "Guestbook:archive");
    }
}
