<?php
/**
 * @author Patrick Kusebauch
 * @version 1.02, 28. 10. 2014
 */
namespace AdminModule\DefaultModule;

/**
 * Control over Guestbook
 *
 * @Secured
 * @Resource("Admin:Default:Guestbook")
 */
class GuestbookPresenter extends BasePresenter
{
    /** @var  \Models\Guestbook */
    protected $guestbook;

    /** @var  \Models\Member */
    protected $members;

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
     * Loads a guestbook post from the database
     *
     * @param int $id Guestbook post ID
     * @return \Nette\Database\Table\ActiveRow      Assossiated post
     */
    protected function loadItem($id)
    {
        $item = $this->guestbook->get($id);
        if (!$item) {
            $this->flashMessage("Vybraný příspěvek neexistuje.", 'error');
            $this->redirect('default');
        }
        return $item;
    }

    /**
     * Edits individual post
     *
     * @Privilege("edit")
     *
     * @param int $id           Guestbook post ID
     */
    public function actionEdit($id)
    {
        $item = $this->loadItem($id);
        $defaults = $item->toArray();
        $this['guestbookForm']->setDefaults($defaults);
    }

    /**
     * Overwiev of posts
     *
     * @Privilege("default")
     */
    public function renderDefault()
    {
        $posts = $this->guestbook->getOrderedPosts();
        $vp = new \VisualPaginator($this, 'vp');
        $page = $vp->page;
        $paginator = $vp->getPaginator();
        $paginator->setItemCount($posts->count());
        $paginator->setItemsPerPage(25);
        $paginator->setPage($page);
        $this->template->posts = $posts
            ->limit($paginator->getLength(), $paginator->getOffset());

    }

    /**
     * Deletes an individual post based on its ID
     *
     * @Privilege("delete")
     *
     * @param int $id           Guestbook post ID
     */
    public function handleDelete($id) {
        $this->guestbook->deletePost($id);
        $this->flashMessage("Zpráva byla smazána");
        $this->redirect('Guestbook:');
    }

    /**
     * (Dis)allows post for viewing
     *
	 * @Privilege("show")
     *
     * @param int $id Guestbook post ID
	 */
	public function handleShow($id)
	{
		$news = $this->guestbook->showPost($id);
		if($news->show) {
			$this->flashMessage("Příspěvek byl zobrazen");
		} else {
			$this->flashMessage("Příspěvek byl odzobrazen");
		}
		$this->redirect('Guestbook:');
	}

    /**
     * Form for editing a post
     *
     * @Privilege("edit")
	 * @Action("edit")
	 */
	protected function createComponentGuestbookForm()
	{
		$form = new \Nette\Application\UI\Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addHidden('id');
		$members = $this->members->getAuthenticatedUsers()
			->fetchPairs('user_id', 'nickname');
		$user_id = $form->addSelect('user_id', 'Ověřený uživatel:', $members)
			->setPrompt('Vyberte uživatele');
		$form->addText('name', 'Jméno:')
            ->setAttribute('size', 30)
			->addConditionOn($form['user_id'], ~\Nette\Application\UI\Form::FILLED)
				->addRule(\Nette\Application\UI\Form::FILLED, 'Musíte buď vybrat uživatele nebo zadat jméno pro příspěvek');
		$user_id->addConditionOn($form['name'], ~\Nette\Application\UI\Form::FILLED)
				->addRule(\Nette\Application\UI\Form::FILLED, 'Musíte buď vybrat uživatele nebo zadat jméno pro příspěvek');
		$form->addDateTimePicker('time', 'Čas příspěvku')
            ->setAttribute('size', 30);
		$form->addTextarea('post', 'Vzkaz:')
            ->setAttribute('cols', 50)
            ->setAttribute('rows', 5)
			->setRequired('Musíte zadat text vzkazu');
		$form->addText('mail', 'E-mail:')
            ->setAttribute('size', 30)
            ->addCondition(\Nette\Application\UI\Form::FILLED)
                ->addRule(\Nette\Application\UI\Form::EMAIL, 'Musí se jednat o platný e-mail');
		$form->addText('web', 'Web:')
            ->setAttribute('size', 30);
		$form->addSubmit('send', 'Změnit');
		$form->onSuccess[] = $this->guestFormSucceded;
		return $form;
	}

    /**
     * Processing of post editing form
     *
     * @Privilege("edit")
     *
     * @param \Nette\Application\UI\Form $form
     */
    public function guestFormSucceded(\Nette\Application\UI\Form $form)
	{
		$values = $form->getValues(TRUE);
		unset($values['send']);
		$item = $this->loadItem($values['id']);
		if($values['user_id']) {
			$values['name'] = NULL;
			$values['mail'] = NULL;
		}
		$item->update($values);
		$this->flashMessage('Přísměvek byl úspěšně editován');
		$this->redirect('default');
	}
}
