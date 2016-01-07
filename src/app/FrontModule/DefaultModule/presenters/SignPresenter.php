<?php
namespace FrontModule\DefaultModule;

use Nette\Application\UI,
	\Nette\Application\UI\Form,
	\Nette\Mail\Message;

/**
 * Dedicated signing in with redirection to last request.
 *
 * Also handles registration, activation and forgot passwords.
 * Pretty much all you need to do with a user while they are not signed in.
 *
 * @author Patrick Kusebauch
 * @version 5.01, 22. 11. 2014
 */
class SignPresenter extends BasePresenter
{

    /** @persistent */
    public $backlink = "";

    /** @var  \Models\Privilege */
    protected $privileges;

    /** @var  \Models\User */
    protected $users;

    /**
     * Injects connection to user model
     *
     * @param \Models\User $user
     * @throws \Nette\InvalidStateException
     */
    public function injectUser(\Models\User $user){
        if ($this->users) {
            throw new \Nette\InvalidStateException('User has already been set');
        }
        $this->users = $user;
    }

    /**
     * Injects connection to privilege model
     *
     * @param \Models\Privilege $privilege
     * @throws \Nette\InvalidStateException
     */
    public function injectPrivilege(\Models\Privilege $privilege){
        if ($this->privileges) {
            throw new \Nette\InvalidStateException('Privilege has already been set');
        }
        $this->privileges = $privilege;
    }

    public function startup()
    {
        parent::startup();
        \AntispamControl::register();
    }

    /**
     * Activates account from e-mail link
     *
     * @param string $username      username of account to activate
     * @param string $token         unique activation key
     */
    public function actionActivate($username, $token)
    {
        $user = $this->users->getByUsername($username);
        if (!$user) {
            $this->flashMessage('Vybraný uživatel neexistuje.');
        } elseif ($this->users->needsRetoken($user->id)) { //token is old
            $token = $this->users->updateToken($user->id);
            $this->sendActivationMail($user->mail, $user->username, $token);
            $this->flashMessage('Platnost aktivačního odkazu vypršela. Zkontrolujte si svůj e-mail pro nový aktivační odkaz.');
        } elseif ($user->token ==! $token) { //token is invalid
            $this->flashMessage('Tento odkaz je neplatný. Zkuste se znovu zaregistrovat.');
        } elseif ($user->active === 1) { // already activated
            $this->flashMessage('Váš účet je již aktivní. Není potřeba jej znovu aktivovat.');
        } else { //everything is ok
            $this->users->activate($user->id);
            $this->flashMessage('Váš účet byl aktivován. Nyní se můžete přihlásit.');
        }
        $this->redirect(':Front:Default:Homepage:');
    }

    /**
     * Redirect user if logged in. Otherwise shows log in form.
     */
    public function actionIn()
	{
		if($this->user->isLoggedIn()){
			$this->restoreRequest($this->backlink);
			$this->redirect(':Admin:Default:Homepage:');
		}
	}

    /**
     * Recover password from e-mail link
     *
     * @param String $username      username of account to recover
     * @param String $token         unique activation key
     */
    public function actionRecover($username, $token) {
        $user = $this->users->getByUsername($username);
        if (!$user) {
            $this->flashMessage('Vybraný uživatel neexistuje.');
            $this->redirect(':Front:Default:Homepage:');
        } elseif ($this->users->needsRetoken($user->id)) { //token is old
            $token = $this->users->updateToken($user->id);
            $this->sendActivationMail($user->mail, $user->username, $token);
            $this->flashMessage('Platnost aktivačního odkazu vypršela. Zkontrolujte si svůj e-mail pro nový aktivační odkaz.');
            $this->redirect(':Front:Default:Homepage:');
        } elseif ($user->token ==! $token) { //token is invalid
            $this->flashMessage('Tento odkaz je neplatný.');
            $this->redirect(':Front:Default:Homepage:');
        } else {
            $this['updateForm']['recover_username']->setValue($username);
            $this['updateForm']['token']->setValue($token);
        }
    }

    /**
     * Send an activation mail to newly registered user
     *
     * @param string $mail              mail address of recipient
     * @param string $username          username picked in registration
     * @param string $token             Activation token
     */
    private function sendActivationMail($mail, $username, $token) {
        $message = new Message;
        $message->addTo($mail);

        $template = $this->createTemplate();
        $template->setFile(__DIR__ . '/../templates/emails/activate.latte');
        $template->title = '27skauti.cz - Aktivace Účtu';
        $template->token = $token;
        $template->username = $username;

        $message->setHtmlBody($template);
        $mailer = new \Nette\Mail\SendmailMailer();
        $mailer->send($message);
    }

    /**
     * Creates form for forgotten password
     *
     * @return Form
     */
    protected function createComponentForgotForm()
    {
        $form = new Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addAntispam();
        $form->addText('forgot_username', 'Přihlašovací jméno:');
        $form->addText('mail', 'Registrační e-mail:');
        $form->addSubmit('send', 'Odeslat');
        $form->onSuccess[] = $this->forgotFormSucceded;
        return $form;
    }

    /**
     * Processes Forgotten Password form
     *
     * @param Form $form
     */
    public function forgotFormSucceded(Form $form)
    {
        $values = $form->getValues();
        $item = $this->users->getByUsername($values->forgot_username);
        if(!$item) {
            $item = $this->users->getByMail($values->mail);
        }
        if(!$item) {
            $form->addError('Uživatel s tímto jménem nebo e-mailem neexistuje.');
        } else {

            // send forgot e-mail
	    $message = new Message;
            $message->addTo($item->mail);

            $template = $this->createTemplate();
            $template->setFile(__DIR__ . '/../templates/emails/forgot.latte');
            $template->username = $values->forgot_username;
            $template->token = $this->users->updateToken($item->id);
            $template->title = '27skauti.cz - Obnovení hesla';

            $message->setHtmlBody($template);
            $mailer = new \Nette\Mail\SendmailMailer();
            $mailer->send($message);

            $this->flashMessage('Postup pro obnovení hesla byl odeslán na e-mail.');
            $this->redirect(':Front:Default:Homepage:');
        }
    }

    /**
     * Renders Registration form for new users
     *
     * @return Form
     */
    protected function createComponentRegisterForm()
	{
		$form = new Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addAntispam();
		$form->addText('registration_username', 'Přihlašovací jméno:')
			->setRequired('Zvolte si přihlašovací jméno');
		$form->addPassword('registration_password', 'Heslo:')
			->setRequired('Zvolte si heslo')
			->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaky', 4)
			->setOption('description', \Nette\Utils\Html::el('td')->setText('Alespoň 4 znaky'));
		$form->addPassword('password_confirm', 'Heslo znovu:')
			->setRequired('Zadejte prosím heslo ještě jednou pro kontrolu')
			->addRule(Form::EQUAL, 'Hesla se neshodují', $form['registration_password']);
		$form->addText('mail', 'E-mail:')
			->setRequired('Zvolte adresu pro aktivační e-mail');
		$form->addText('name', 'Jméno:')
			->setOption('description', \Nette\Utils\Html::el('td')->setText('Pro členy oddílu'));
		$form->addText('surname', 'Příjmení:')
			->setOption('description', \Nette\Utils\Html::el('td')->setText('Pro členy oddílu'));
		$form->addSubmit('send', 'Registrovat');
		$form->onSuccess[] = $this->registerFormSucceded;
		return $form;
	}

    /**
     * Send request for connecting an account with group member
     *
     * @param string $username              Account username
     * @param string $name                  Member's name
     * @param string $surname               Member's surname
     */
    private function sendConnectionMail($username, $name, $surname) {
        $message = new Message;
        $recipient = $this->context->parameters['supportMail'];
        $message->addTo($recipient);

        $template = $this->createTemplate();
        $template->setFile(__DIR__ . '/../templates/emails/connect.latte');
        $template->title = '27skauti.cz - Propojení účtů';
        $template->username = $username;
        $template->name = $name;
        $template->surname = $surname;

        $message->setHtmlBody($template);
        $mailer = new \Nette\Mail\SendmailMailer();
        $mailer->send($message);
    }

    /**
     * Processes Registration form
     *
     * @param Form $form
     */
    public function registerFormSucceded(Form $form)
	{
		$values = $form->getValues();
		$item = $this->users->getByUsername($values->registration_username);
		if(!$item) {//user with this username does not exists
            $token = $this->users->register($values->registration_username,
                $values->registration_password, $values->mail);
            $this->sendActivationMail($values->mail, $values->registration_username, $token);

			if($values->name && $values->surname) {
                $this->sendConnectionMail($values->registration_username, $values->name, $values->surname);
			}

			$this->flashMessage('Registrace proběhla úspěšně. Zkontrolujte svůj e-mail pro aktivaci účtu.');
			$this->redirect(':Front:Default:Homepage:');
		} elseif (!$item->active) { //not yet activated account => resend the mail
            $token = $this->users->updateToken($item->id);
            $this->sendActivationMail($item->mail, $item->username, $token);
            $this->flashMessage('Zkontrolujte svůj e-mail pro aktivaci účtu.');
            $this->redirect(':Front:Default:Homepage:');

        } else {
            $form->addError('Tento uživatel již existuje. Možná chcete raději obnovit své heslo.');
        }
	}

    /**
     * Form for updating password when you forgot it
     *
     * @return Form
     */
    protected function createComponentUpdateForm()
    {
        $form = new Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addAntispam();
        $form->addHidden('recover_username');
        $form->addHidden('token');
        $form->addPassword('recover_password', 'Heslo:')
            ->setRequired('Zvolte si heslo')
            ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaky', 4)
            ->setOption('description', \Nette\Utils\Html::el('td')->setText('Alespoň 4 znaky'));
        $form->addPassword('password_confirm', 'Heslo znovu:')
            ->setRequired('Zadejte prosím heslo ještě jednou pro kontrolu')
            ->addRule(Form::EQUAL, 'Hesla se neshodují', $form['recover_password']);
        $form->addSubmit('send', 'Změnit');
        $form->onSuccess[] = $this->updateFormSucceded;
        return $form;
    }

    /**
     * Processing of Update Password Form
     *
     * @param Form $form
     */
    public function updateFormSucceded(Form $form)
    {
        $values = $form->getValues();

        $user = $this->users->getByUsernameAndToken($values->recover_username, $values->token);
        if(!$user) {
            $form->addError('Zadaný uživatel neexistuje.');
        } else {
            $this->users->updatePassword($user->id, $values->recover_password);
            $this->flashMessage('Heslo bylo úspěšně změněno.');
            $this->redirect(':Front:Default:Homepage:');
        }
    }

    /**
     * Dedicated processing for Sign In Form
     * It allows for redirecting user back with the last request before being pulled here
     *
     * @param Form $form
     */
    public function signInFormSucceeded(Form $form)
    {
        $values = $form->getValues();

        if ($values->remember) {
            $this->getUser()->setExpiration('14 days', FALSE);
        } else {
            $this->getUser()->setExpiration('40 minutes', TRUE);
        }

        try {
            $this->getUser()->login($values->username, $values->password);
            $this->restoreRequest($this->backlink);
            $this->redirect(':Admin:Default:Homepage:');
        } catch (\Nette\Security\AuthenticationException $e) {
            $form->addError($e->getMessage());
        }
    }
}
