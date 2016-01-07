<?php
namespace AdminModule\DefaultModule;
/**
 * User related tasks
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 *
 * @Secured
 * @Resource("Admin:Default:User")
 */
class UserPresenter extends BasePresenter
{

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
	 * @Privilege("default")
 	 */
	public function actionDefault(){}

	/**
     * Form for changing password
     *
	 * @Action("default")
     * @Privilege("default")
	 */
	protected function createComponentChangePasswordForm()
	{
		$form = new \Nette\Application\UI\Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addPassword('oldpassword', 'Současné heslo:')
			->setRequired('Zadejte současné heslo');
		$form->addPassword('password', 'Nové heslo:')
			->setRequired('Zvolte si heslo')
			->addRule(\Nette\Application\UI\Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků', 6);
		$form->addPassword('passwordVerify', 'Heslo pro kontrolu:')
			->setRequired('Zadejte prosím heslo ještě jednou pro kontrolu')
			->addRule(\Nette\Application\UI\Form::EQUAL, 'Hesla se neshodují', $form['password']);
		$form->addSubmit('send', 'Změnit');
		$form->onSuccess[] = $this->changePasswordSucceded;
		return $form;
	}

    /**
     * Processing of change user password form
     *
     * @param \Nette\Application\UI\Form $form
     *
     * @Privilege("default")
     */
    public function changePasswordSucceded(\Nette\Application\UI\Form $form)
	{
		$values = $form->getValues(TRUE);
		$row = $this->users->get($this->user->id);
        if (!\Nette\Security\Passwords::verify($values['oldpassword'], $row->password)) {
            $form->addError('Nesprávné heslo.');
        } else {
            $this->users->updatePassword($row->id, $values['password']);
            $this->flashMessage('Heslo bylo změněno');
        }
		$this->redirect('this');
	}
}
