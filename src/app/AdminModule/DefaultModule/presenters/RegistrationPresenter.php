<?php
namespace AdminModule\DefaultModule;
/**
 * Registration information
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 *
 * @Secured
 * @Resource("Admin:Default:Registration")
 */
class RegistrationPresenter extends BasePresenter
{

    /** @var  \Models\Member */
    protected $members;

    /** @var  \Models\Registration */
    protected $registrations;

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
     * Injects connection to member model
     *
     * @param \Models\Registration $registration
     * @throws \Nette\InvalidStateException
     */
    public function injectRegistration(\Models\Registration $registration){
        if ($this->registrations) {
            throw new \Nette\InvalidStateException('Registration has already been set');
        }
        $this->registrations = $registration;
    }

    /**
     * Loads an item
     *
     * @param string $id
     * @return FALSE|\Nette\Database\Table\ActiveRow
     */
    protected function loadItem($id)
    {
        $item = $this->registrations->get($id);
        if (!$item) {
            $this->flashMessage("Vybraný člen neexistuje.", 'error');
            $this->redirect('default');
        }
        return $item;
    }

    /**
     * Creates a new registration
     *
     * @Privilege("create")
     */
    public function actionCreate()
    {
        $this['registrationForm']['member_nickname']->setDisabled();
    }

    /**
     * Edits a current registration
     *
	 * @Privilege("edit")
     *
     * @param string $member_nickname           Nickname of the member
	 */
	public function actionEdit($member_nickname)
	{
		$this->template->nickname = $member_nickname;
		$item = $this->loadItem($member_nickname);
		$defaults = $item->toArray();
		$this['registrationForm']->setDefaults($defaults);
		$this['registrationForm']['nickname']->setDisabled();
		$this['registrationForm']['member_nickname']->setAttribute('readonly', 'readonly');
	}

    /**
     * Registration overview
     *
     * @Privilege("default")
     */
    public function renderDefault()
    {
        $sections = $this->registrations->getAllGroups();
        $groups = [];
        foreach ($sections as $group){
            $groups[$group]['name'] = $group;
            $groups[$group]['members'] = $this->registrations->getMembersOfGroup($group);
        }
        $this->template->groups = $groups;
    }

    /**
     * Deletes a registration
     *
	 * @Privilege("delete")
     *
     * @param String $member_nickname           Nickname of the member
	 */
	public function handleDelete($member_nickname)
	{
		$item = $this->loadItem($member_nickname);
		$item->delete();
		$this->flashMessage('Záznam byl úspěšně smazán');
		$this->redirect('this');
	}

	/**
     * Registration form
     *
     * @Action("create", "edit")
     * @Privilege("create", "edit")
	 */
	protected function createComponentRegistrationForm()
	{
		$form = new \Nette\Application\UI\Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $members = $this->members->getMembersWithoutRegistration()
			->fetchPairs('nickname', 'nickname');
		$member_nickname = $form->addSelect('nickname', 'Členové bez registrace:', $members)
			->setPrompt('Vyberte člena');
		$form->addText('member_nickname', 'Přesdívka:')
			->addConditionOn($form['nickname'], ~\Nette\Application\UI\Form::FILLED)
				->addRule(\Nette\Application\UI\Form::FILLED, 'Musíte vybrat přezdívku');
		$member_nickname->addConditionOn($form['member_nickname'], ~\Nette\Application\UI\Form::FILLED)
				->addRule(\Nette\Application\UI\Form::FILLED, 'Musíte vybrat přezdívku');
		$form->addDatePicker('birth_date', 'Datum Narození:')
			->setRequired('Vyplňte datum narození');
		$form->addText('oddil', 'Oddíl:')
			->setType('number');
		$form->addTextarea('address', 'Adresa:')
			->setOption('description', \Nette\Utils\Html::el('td')->setText('Oddělujte novým řádkem'))
			->setAttribute('rows', 4)
			->setAttribute('cols', 30);
		$form->addText('mobile', 'Telefon:');
		$form->addText('registration_number', 'Registrační Číslo:')
			->setOption('description', \Nette\Utils\Html::el('td')->setText('To samé co v IS skautu'));
		$form->addSubmit('send', 'Přidat/Změnit');
		$form->onSuccess[] = $this->registrationFormSucceded;
		return $form;
	}

    /**
     * Processing of registration form
     *
     * @Privilege("create", "edit")
     *
     * @param \Nette\Application\UI\Form $form
     */
    public function registrationFormSucceded(\Nette\Application\UI\Form $form)
	{
		$values = $form->getValues(TRUE);
		unset($values['send']);
		if(!array_key_exists('member_nickname', $values)) {// registration for new member
			$values['member_nickname'] = $values['nickname'];
			unset($values['nickname']);
		}
		$item = $this->registrations->get($values['member_nickname']);
		if($item) {
			$item->update($values);
			$this->flashMessage('Záznam byl úspěšně editován');
		} else {
			$this->registrations->insert($values);
			$this->flashMessage('Záznam byl úspěšně přidán');
		}
		$this->redirect('default');
	}

}
