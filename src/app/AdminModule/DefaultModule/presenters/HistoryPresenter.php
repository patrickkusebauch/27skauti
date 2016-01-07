<?php
namespace AdminModule\DefaultModule;
/**
 * Control over the history of the group
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 *
 * @Secured
 * @Resource("Admin:Default:History")
 */
class HistoryPresenter extends BasePresenter
{

    /** @var  \Models\History */
    protected $histories;

    /**
     * Injects connection to history model
     *
     * @param \Models\History $history
     * @throws \Nette\InvalidStateException
     */
    public function injectHistory(\Models\History $history) {
        if ($this->histories) {
            throw new \Nette\InvalidStateException('History has already been set');
        }
        $this->histories = $history;
    }

    /**
     * Loads a history from particular school year
     *
     * @param string $year                          format yyyy-yyyy
     * @return \Nette\Database\Table\ActiveRow      history of that school year
     */
    protected function loadItem($year)
    {
        $item = $this->histories->get($year);
        if (!$item) {
            $this->flashMessage("Zápis historie z roku $year neexistuje.", 'error');
            $this->redirect('default');
        }
        return $item;
    }

    /**
     * Creates a new history for a school year
     *
     * @Privilege("create")
     */
    public function actionCreate(){}

    /**
     * Editation of history from particular year
     *
     * @Privilege("edit")
     */
    public function actionEdit($year)
    {
        $item = $this->loadItem($year);
        $defaults = $item->toArray();
        $this['historyForm']->setDefaults($defaults);
        $this->template->year = $item->year;
    }

    /**
     * Deletes a history from year
     *
	 * @Privilege("delete")
	 */
	public function handleDelete($year)
	{
		$item = $this->loadItem($year);
		$item->delete();
		$this->flashMessage("Zápis historie z roku $year byl úspěšně vymazán.");
		$this->redirect('default');
	}

    /**
     * Overwiev of histories
     *
     * @Privilege("default")
     */
    public function renderDefault()
    {
        $this->template->histories = $this->histories->getOrderedHistories();
    }

    /**
     * Form for creating or editing a history
     *
	 * @Action("create", "edit")
     * @Privilege("create", "edit")
	 */
	protected function createComponentHistoryForm()
	{
		$form = new \Nette\Application\UI\Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addText('year', 'Ročník:')
			->setRequired('Musíte vyplnit rok')
			->setOption('description', \Nette\Utils\Html::el('td')->setText('(formát "rrrr - rrrr")'))
			->setAttribute('size', 40);
		$form->addText('game', 'Táborová hra:')
			->setDefaultValue('???')
			->setRequired('Musíte vyplnit táborovou hru')
			->setAttribute('size', 40);
		$form->addTextarea('leaders', 'Vedoucí:')
			->setRequired('Musíte vyplnit vedoucí oddílu')
			->setOption('description', \Nette\Utils\Html::el('td')->setText('(oddělujte čárkou)'))
            ->setAttribute('rows', 4)
            ->setAttribute('cols', 40);
		$form->addTextarea('deputies', 'Zástupci:')
			->setRequired('Musíte vyplnit zástupce vedoucího')
			->setOption('description', \Nette\Utils\Html::el('td')->setText('(oddělujte čárkou)'))
            ->setAttribute('rows', 4)
			->setAttribute('cols', 40);
		$form->addTextarea('oldscouts', 'Oldskauti:')
			->setRequired('Musíte vyplnit olskauty')
			->setOption('description', \Nette\Utils\Html::el('td')->setText('(oddělujte čárkou)'))
            ->setAttribute('rows', 4)
			->setAttribute('cols', 40);
		$form->addTextarea('rangers', 'Roveři:')
			->setRequired('Musíte vyplnit rovery')
			->setOption('description', \Nette\Utils\Html::el('td')->setText('(oddělujte čárkou)'))
            ->setAttribute('rows', 4)
			->setAttribute('cols', 40);
		$form->addText('club', 'Klubovna:')
			->setRequired('Musíte vyplnit klubovny')
			->setAttribute('size', 40);
		$form->addText('camp', 'Tábor:')
			->setDefaultValue('???')
			->setRequired('Musíte vyplnit tábořiště')
			->setAttribute('size', 40);
		$form->addTextarea('mloci', 'Mloci:')
			->setOption('description', \Nette\Utils\Html::el('td')->setText('(nový člen na nový řádek)'))
            ->setAttribute('rows', 4)
			->setAttribute('cols', 40);
		$form->addTextarea('tucnaci', 'Tučňáci:')
			->setOption('description', \Nette\Utils\Html::el('td')->setText('(nový člen na nový řádek)'))
            ->setAttribute('rows', 4)
			->setAttribute('cols', 40);
		$form->addTextarea('jezevci', 'Jezevci:')
			->setOption('description', \Nette\Utils\Html::el('td')->setText('(nový člen na nový řádek)'))
            ->setAttribute('rows', 4)
			->setAttribute('cols', 40);
		$form->addUpload('file', 'Náhled:')
			->addCondition(\Nette\Application\UI\Form::FILLED)
			->addRule(\Nette\Application\UI\Form::IMAGE, 'Náhled musí být JPEG, PNG nebo GIF.');
		$form->addSubmit('send', 'Přidat/Změnit');
		$form->onSuccess[] = $this->historyFormSucceded;
		return $form;
	}

    /**
     * Processing of the form
     *
     * @Privilege("create", "edit")
     *
     * @param \Nette\Application\UI\Form $form
     */
    public function historyFormSucceded(\Nette\Application\UI\Form $form)
	{
		$values = $form->getValues(TRUE);
		unset($values['send']);

		//handle file upload
		$file = $values['file'];
		unset($values['file']);
        $params = $this->context->parameters;
		$path = $params['wwwDir'] . $params['historyPhotosStorage'];
		if($file->isOk()) //is there a file?
		{
			if($file->isImage()){ //make sure the file will be JPEG
				$image = $file->toImage();
				$filename = '/' . $values['year'] . '.jpg';
				$image->save($path . $filename, 100, \Nette\Image::JPEG);
			}
		}


		$item = $this->histories->get($values['year']);
		if($item) { //do an update
			$item->update($values);
			$this->flashMessage('Historie oddílu pro rok ' . $values['year'] . ' byla změněna.');
		} else { //do an insert
			$this->histories->insert($values);
			$this->flashMessage('Historie oddílu pro rok ' . $values['year'] . ' byla přidána.');
		}
		$this->redirect('default');
	}
}
