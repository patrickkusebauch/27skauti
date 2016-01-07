<?php
namespace AdminModule\DefaultModule;

use \Nette\Application\UI\Form;

/**
 * Control over the organizational structure
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 *
 * @Secured
 * @Resource("Admin:Default:Organization")
 */
class OrganizationPresenter extends BasePresenter
{
    /** @var  \Models\Member */
    protected $members;

    /** @var  \Models\User */
    protected $users;

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
     * Loads a member row by nickname
     *
     * @param string $nickname                          Member's nickname
     * @return FALSE|\Nette\Database\Table\ActiveRow
     */
    protected function loadItem($nickname)
    {
        $item = $this->members->get($nickname);
        if (!$item) {
            $this->flashMessage("Vybraný člen neexistuje", 'error');
            $this->redirect('default');
        }
        return $item;
    }

    /**
     * Edits an idividual member by nickname
     *
	 * @Privilege("edit")
     *
     * @param string $nickname          Member's nickname
	 */
	public function actionEdit($nickname)
	{
		$this->template->nickname = $nickname;
		$item = $this->loadItem($nickname);
		$defaults = $item->toArray();
		$this['organizationForm']['nickname']->setAttribute('readonly', 'readonly');
		if($item->user_id !== NULL){
			$this['organizationForm']['user_id']->setDisabled()
				->setPrompt($item->user->username)
				->setOption('description', \Nette\Utils\Html::el('td')->setText('Už propojeno'));
            unset($defaults['user_id']);
		}
        $this['organizationForm']->setDefaults($defaults);
	}

    /**
     * Show all the organization members
     *
     * @Privilege("default")
     */
    public function renderDefault()
    {
        $this->template->members = $this->members->getOrderedMembers();
    }

    /**
     * Deletes a member ny nickname
     *
	 * @Privilege("delete")
     *
     * @param string $nickname          Member's nickname
	 */
	public function handleDelete($nickname)
	{
		$item = $this->loadItem($nickname);
		$item->delete();
		$this->flashMessage('Záznam byl úspěšně smazán');
		$this->redirect('this');
	}

	/**
     * Form for organization member editation
     *
     * @Action("edit", "create")
     * @Privilege("edit", "create")
	 */
	protected function createComponentOrganizationForm()
	{
		$form = new Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $users = $this->users->getUnconnectedUsers()
			->fetchPairs('id', 'username');
		$form->addSelect('user_id', 'Uživatel:', $users)
			->setPrompt('Propojit s uživatelem');
		$form->addText('nickname', 'Přezdívka:')
			->setRequired('Musíte zadat přezdívku');
		$form->addText('title', 'Titul:')
			->setOption('description', \Nette\Utils\Html::el('td')->setText('Titul před jménem'));
		$form->addText('name', 'Křestní jméno:')
			->setRequired('Musíte zadat jméno');
		$form->addText('surname', 'Příjmení:')
			->setRequired('Musíte zadat příjmení');
		$form->addUpload('file', 'Profilová fotka:')
			->addCondition(Form::FILLED)
			->addRule(Form::IMAGE, 'Foto musí být JPEG, PNG nebo GIF.');
		$form->addText('group', 'Pozice:');
		$form->addSelect('stripe', 'Frčky:', [
			'vedouci.gif' => 'Vedoucí oddílu',
			'zastupce.gif' => 'Zástupce vedoucího',
			'radce_oddilu.gif' => 'Rádce oddílové družiny',
			'rover.gif' => 'Rover',
			'radce.gif' => 'Rádce',
			'podradce.gif' => 'Podrádce'])
			->setPrompt('--Bez frček--')
			->setOption('description', \Nette\Utils\Html::el('td')->setText('Možnosti: Vedoucí oddílu, Zástupce vedoucího oddílu, Rover, Mlok, Tučňák, Nováček, Oldskaut, Rádce, Podrádce. Lze přidat více jak jednu možnost.'));
		$form->addDatePicker('entered', 'Vstup do oddílu:')
			->setRequired('Musíte vyplnit vstup do oddílu');
		$form->addTextarea('note', 'Osobní poznámka:')
			->setAttribute('rows', 4);
		$form->addSubmit('send', 'Přidat/Upravit');
		$form->onSuccess[] = $this->organizationFormSucceded;
		return $form;
	}

    /**
     * Processing of organization member editation form
     *
     * @Privilege("edit", "create")
     *
     * @param Form $form
     */
    public function organizationFormSucceded(Form $form)
	{
		$values = $form->getValues(TRUE);
		unset($values['send']);

		//handle file upload
		$file = $values['file'];
		unset($values['file']);
        $params = $this->context->parameters;
		$path = $params['wwwDir'] . $params['memberPhotosStorage'] . '/';
		if($file->isOk()) //is there a file?
		{
			if($file->isImage()){ //make sure the file will be JPEG
				$image = $file->toImage();
				$filename = \Nette\Utils\Strings::lower(\Nette\Utils\Strings::toAscii($values['nickname'])) . ".jpg";
				$image->save($path . $filename, 100, \Nette\Image::JPEG);
			}
		}


		$item = $this->members->get($values['nickname']);
		if($item) {
			$item->update($values);
			$this->flashMessage('Záznam byl úspěšně aktualizován');
		} else {
			$this->members->insert($values);
			$this->flashMessage('Záznam byl úspěšně vytvořen');
		}
		$this->redirect('default');

	}
}
