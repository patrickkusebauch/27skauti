<?php
namespace OddilModule\AdminModule;

/**
 * Overview of the admin
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 *
 * @Secured
 * @Resource("Oddil:Songbook")
 */
class SongbookPresenter extends BasePresenter
{
    /** @var  \Models\Songbook */
    protected $songbook;

    /**
     * Inject connection to songbook model
     *
     * @param \Models\Songbook $songbook
     * @throws \Nette\InvalidStateException
     */
    public function injectSongbook(\Models\Songbook $songbook) {
        if ($this->songbook) {
            throw new \Nette\InvalidStateException('Stezky has already been set');
        }
        $this->songbook = $songbook;
    }

    /**
     * Loads a guestbook post from the database
     *
     * @param int $id Songbook ID
     * @return \Nette\Database\Table\ActiveRow      Assossiated post
     */
    protected function loadItem($id)
    {
        $item = $this->songbook->get($id);
        if (!$item) {
            $this->flashMessage("Vybraný příspěvek neexistuje.", 'error');
            $this->redirect('default');
        }
        return $item;
    }

    /**
     * Admin homepage
     *
	 * @Privilege("default")
	 */
	public function renderDefault()
	{
		$this->template->songbook = $this->songbook->findAll();
	}

    /**
     * Admin homepage
     *
     * @Privilege("add")
     */
    public function renderAdd(){}

    /**
     * Admin homepage
     *
     * @param $id
     *
     * @Privilege("delete")
     */
    public function handleDelete($id)
    {
        $item = $this->loadItem($id);
        $item->delete();
        $this->flashMessage("Zásnam s ID $id byl úspěšně smazán.");
        $this->redirect('default');
    }

    /**
     * Admin homepage
     *
     * @param $id
     *
     * @Privilege("edit")
     */
    public function renderEdit($id)
    {
        $item = $this->loadItem($id);
        $defaults = $item->toArray();
        $this['editSongForm']->setDefaults($defaults);
    }


    public function createComponentEditSongForm()
    {
		$form = new \Nette\Application\UI\Form;
		$form->addHidden('id');
		$form->addText('name', 'Jméno písně:');
		$form->addText('artist', 'Interpret:');
		$form->addSelect('group', 'Skupina:', [
			'Oddílový' => 'Základní dětský',
			'Táborový' => 'Rozšířený dětský',
			'Střediskový' => 'Táborákové písně',
			'Roverský' => 'Nevhodné pro bobany'
		]);
		$form->addTextarea('lyrics', 'Text:', 50)
			->setAttribute('class', 'mceEditor');
		$form->addTextarea('notes', 'Poznámky:');
		$form->addSubmit('send', 'Odeslat');
		$form->getElementPrototype()->onsubmit('tinyMCE.triggerSave()');
        $form->onSuccess[] = $this->editSongFormSucceded;
		return $form;
	}

    /**
     * Processing of post editing form
     *
     * @Privilege("edit")
     *
     * @param \Nette\Application\UI\Form $form
     */
    public function editSongFormSucceded(\Nette\Application\UI\Form $form)
    {
        $values = $form->getValues(TRUE);
        unset($values['send']);
        $item = $this->loadItem($values['id']);
        if($item) { //do an update
            $item->update($values);
            $this->flashMessage('Píseň byla upravena.');
        } else { //do an insert
            $this->songbook->insert($values);
            $this->flashMessage('Píseň byla přidána.');
        }
        $this->redirect('default');
    }
}
