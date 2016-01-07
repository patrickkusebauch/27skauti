<?php
namespace AdminModule\DefaultModule;

use \Nette\Application\UI\Form;
/**
 * Changing the user privileges
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 *
 * @Secured
 * @Resource("Admin:Default:Privilege")
 */
class PrivilegePresenter extends BasePresenter
{
	/** @persistent */
	public $user_id = NULL;

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
	/**
     * Overview of privileges
     *
	 * @Privilege("default")
	 */
	public function actionDefault($user_id)
	{
		$user = $this->privileges->get($this->user_id);
		$this->template->privilege = $user;
		if($user) {
			$this['pickUserForm']->setDefaults(['user_id' => $user_id]);
			$this['changePrivilegeForm']->setDefaults($user->toArray());
		}
	}

    /**
     * Form for modifying privileges
     *
     * @Privilege("edit")
     * @Action("default")
     */
    protected function createComponentChangePrivilegeForm()
    {
        $form = new Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addSelect('base', 'Obecně', [
            'člen' => 'Člen']);
        $form->addSelect('news', 'Aktuality', [
            'vstup' => 'Vstup',
            'vytváření/editace' => 'Vytváření/Editace',
            'zobrazování' => 'Zobrazování',
            'mazání' => 'Mazání'])
            ->setPrompt('Zakázat přístup');
        $form->addSelect('event', 'Akce/Kalendář', [
            'vstup' => 'Vstup',
            'vytváření/editace' => 'Vytváření/Editace',
            'zobrazování' => 'Zobrazování',
            'mazání' => 'Mazání'])
            ->setPrompt('Zakázat přístup');
        $form->addSelect('chronicle', 'Kronika/Historie oddílu', [
            'vstup' => 'Vstup',
            'vytváření/editace' => 'Vytváření/Editace',
            'popisky' => 'Popisky',
            'generování' => 'Generování',
            'zobrazování' => 'Zobrazování',
            'mazání' => 'Mazání'])
            ->setPrompt('Zakázat přístup');
        $form->addSelect('vip', 'VIP Kronika', [
            'vstup' => 'Vstup',
            'vytváření/editace' => 'Vytváření/Editace',
            'popisky' => 'Popisky',
            'generování' => 'Generování',
            'zobrazování' => 'Zobrazování',
            'mazání' => 'Mazání'])
            ->setPrompt('Zakázat přístup');
        $form->addSelect('hlasinek', 'Hlásínek', [
            'vstup' => 'Vstup',
            'vytváření' => 'Vytváření',
            'mazání' => 'Mazání'])
            ->setPrompt('Zakázat přístup');
        $form->addSelect('registration', 'Organizace/Registrace', [
            'vstup' => 'Vstup',
            'vytváření/editace' => 'Vytváření/Editace',
            'mazání' => 'Mazání'])
            ->setPrompt('Zakázat přístup');
        $form->addSelect('guestbook', 'Kniha návštěv', [
            'vstup' => 'Vstup',
            'vytváření/editace' => 'Vytváření/Editace',
            'zobrazování' => 'Zobrazování',
            'mazání' => 'Mazání'])
            ->setPrompt('Zakázat přístup');
        $form->addSelect('privilege', 'Práva', [
            'vstup' => 'Vstup',
            'vytváření/editace' => 'Vytváření/Editace',
            'mazání' => 'Mazání'])
            ->setPrompt('Zakázat přístup');
        $form->addSubmit('send', 'Změnit práva');
        $form->onSuccess[] = $this->changePrivilegeFormSucceded;
        return $form;
    }

    /**
     * Processing of form for changing privileges
     *
     * @Privilege("edit")
     * @param Form $form
     */
    public function changePrivilegeFormSucceded(Form $form)
    {
        $values = $form->getValues();
        $this->privileges->get($this->user_id)->update($values);
        $this->flashMessage('Přístupová práva byla úspěšně změněna');
        $this->user_id = NULL;
        $this->redirect('default');
    }

    /**
     * Form to pick a member to modify privileges
     *
	 * @Action("default")
	 * @Privilege("default")
	 */
	protected function createComponentPickUserForm()
	{
		$form = new Form;
		$form->addSelect('user_id', 'Zobrazit práva pro uživatele:',
		        $this->users->getOrderedUsers()->fetchPairs('id', 'username')
            )->setPrompt('Vyberte uživatele')
			->setAttribute('onChange', 'submit()');
		$form->onSuccess[] = $this->pickUserFormSucceded;
		return $form;
	}

    /**
     * Processing of Pick User form
     *
     * @Privilege("default")
     *
     * @param Form $form
     */
    public function pickUserFormSucceded(Form $form)
	{
		$values = $form->getValues();
		$this->redirect('default', $values->user_id);
	}
}
