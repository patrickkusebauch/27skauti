<?php
namespace AdminModule\DefaultModule;
use Tracy\Debugger;

/**
 * Posting and managing the news
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 *
 * @Secured
 * @Resource("Admin:Default:News")
 */
class NewsPresenter extends BasePresenter
{

    /** @var \Models\Event */
    protected $events;

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

    /**
     * Load a news post by its ID
     *
     * @param int $id       News ID
     * @return FALSE|\Nette\Database\Table\ActiveRow
     */
    protected function loadItem($id)
    {
        $post = $this->news->get($id);
        if(!$post) {
            $this->flashMessage("Novinka s tímto id neexistuje");
            $this->redirect('default');
        }
        return $post;
    }

    /**
     * Adding dependand select box for Form
     */
    protected function startup() {
        parent::startup();
        \DependentSelectBox\JsonDependentSelectBox::register('addJDSelect');
    }

    /**
     * Creates a news post
     *
	 * @Privilege('create')
	 */
	public function actionCreate(){}

    /**
     * Edits a news post
     *
	 * @Privilege('edit')
     *
     * @param int $id           News ID
	 */
	public function actionEdit($id)
	{
		$post = $this->loadItem($id);
        $this->template->name = $post->heading;
        $post = $post->toArray();
        unset($post['event_id']);
		$this['editNewsForm']->setValues($post);
        $this['editNewsForm']['type']->setDisabled();
        $this['editNewsForm']['event_id']->setDisabled();
    }

    /**
     * Allows for AJAJ response
     */
    protected function beforeRender() {
        parent::beforeRender();
        \DependentSelectBox\JsonDependentSelectBox::tryJsonResponse($this);
    }

    /**
     * Overview of news
     *
     * @Privilege("default")
     */
    public function renderDefault()
    {
        $news = $this->news->getOrderedNews();
        $vp = new \VisualPaginator($this, 'vp');
        $page = $vp->page;
        $paginator = $vp->getPaginator();
        $paginator->setItemCount($news->count());
        $paginator->setItemsPerPage(50);
        $paginator->setPage($page);
        $this->template->news = $news
            ->limit($paginator->getLength(), $paginator->getOffset());
    }

    /**
     * Deleting a news post
     *
	 * @Privilege("delete")
     *
     * @param int $id           News ID
	 */
	public function handleDelete($id) {
		$this->loadItem($id)->delete();
		$this->flashMessage("Zpráva byla smazána");
		$this->redirect('News:');
	}

    /**
     * Changing visibility of news posts
     *
	 * @Privilege("show")
     *
     * @param int $id           News ID
	 */
	public function handleShow($id)
	{
		$news = $this->news->showNews($id);
		if(!$news->show) {
			$this->flashMessage("Zpráva byla odzobrazena");
		} else {
			$this->flashMessage("Zprava byla zobrazena");
		}
		$this->redirect('News:');
	}

    /**
	 * Form for adding and editing News
	 *
     * @Action('create', 'edit')
     * @Privilege('create', 'edit')
	 */
	protected function createComponentEditNewsForm($name)
	{
		$form = new \Nette\Application\UI\Form($this, $name);
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addHidden('id');
		$form->addSelect('type', 'Typ aktuality:', [
            'Zpráva' => 'Zpráva',
		//	'Akce' => 'Akce',
		//	'Kronika' => 'Kronika',
		])
            ->setRequired('Musíte vybrat typ aktuality');
		$form->addJDSelect('event_id', 'Vyberte akci:', $form['type'], array($this, "getValuesEventId"));
		$form->addText('heading', 'Nadpis:')
			->setRequired('Musíte vyplnit nadpis')
            ->setAttribute('size', 60);
		$form->addTextarea('content', 'Text aktuality:')
			->setRequired('Musíte vyplnit text aktuality')
            //TODO ->setAttribute('class', 'mceEditor')
            ->setAttribute('rows', 5)
            ->setAttribute('cols', 60);
		if($this->user->isAllowed('Admin:Default:News', 'show')){
			$form->addCheckbox('show', 'Zobrazit aktualitu')
				->setDefaultValue(TRUE);
		}
		$form->addSubmit('send', 'Odeslat');
        $form->onSuccess[] = $this->editNewsFormSucceded;
        $form->getElementPrototype()->onsubmit('tinyMCE.triggerSave()');
		return $form;
	}

    /**
     * Custom values loading function for dependent select
     *
     * @param $form
     * @return array ('value' => 'text')            for selectbox
     */
    public function getValuesEventId($form)
    {
        $type = $form['type']->getValue();
        switch ($type) {
            case 'Akce':
                $event = $this->events->getEventsWithoutNews();
                break;
            case 'Kronika':
                $event = $this->events->getChroniclesWithoutNews();
                break;
            default:
                return ['' => '- - - - -'];
        }
        $event = $event->fetchAll();
        array_walk($event, function(&$value, $key) use (&$event){
            $value = $value->dateend->format('Y/m/d') . ' - ' . $value->name;
        });
        return $event;

    }

    /**
	 * Processing of News editing form
	 *
     * @Privilege('create', 'edit')
     *
     * @param $button
	 */
	public function editNewsFormSucceded($button)
	{
		$values = $button->form->getValues(TRUE);
		$values['posted'] = new \DateTime();
		if($this->user->isAllowed('Admin:Default:News', 'show')){ // User can choose
			$values['show'] = $values['show'] ? 1 : 0; //translate TRUE/FALSE to 1/0
		} else {
			$values['show'] = 0; //default value
		}

		if($values['id']) { //update
			$this->loadItem($values['id'])->update($values);
			$this->flashMessage('Aktualita byla úspěšně upravena');
		} else { //insert
			if(empty($values['event_id'])) {
				$values['event_id'] = NULL;
			}
			$this->news->insert($values);
			$this->flashMessage('Aktualita byla úspěšně přidána');
		}
		$this->redirect('default');
	}
}
