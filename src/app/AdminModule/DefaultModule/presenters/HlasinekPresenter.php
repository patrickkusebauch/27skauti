<?php
namespace AdminModule\DefaultModule;
use \Nette\Application\UI\Form;
/**
 * Control over "Hlásínek"
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 *
 * @Secured
 * @Resource("Admin:Default:Hlasinek")
 */
class HlasinekPresenter extends BasePresenter
{
    /**
     * Load all the folders with hlásínek
     *
     * @return array    Folders with Hlasínek
     */
    private function loadFolders() {
        $params = $this->context->parameters;
        $folders = scandir($params['wwwDir'] . $params['hlasinekStorage'], SCANDIR_SORT_DESCENDING);
        array_pop($folders); // ".."
        array_pop($folders);// "."
        return $folders;
    }

    /**
     * Add all the files for chosen hlásínek
     *
     * @Privilege("addall")
     *
     * @param String $folder            Name of the folder with Hlasínek
     * @param int $month_number         Number of the month
     */
    public function actionAddall($folder, $month_number)
    {
        if(!$folder || !$month_number) {
            $this->flashMessage('Je potřeba vybrat hlásínek pro který nahráváš soubory.');
            $this->redirect('Hlasinek:');
        }
        $this['addHlasinekForm']->setDefaults([
            'folder' => $folder,
            'month_number' => $month_number
        ]);
        $template = $this->template;
        $template->month_number = $month_number;
        $template->year = mb_substr($folder, 0, 4);
    }

    /**
     * Overwiev of "Hlásínek"
     *
     * @Privilege("delete")
     */
    public function renderDefault()
    {
        $this->template->folders = $this->loadFolders();
    }

    /**
     * Deletes a file
     *
	 * @Privilege("delete")
     *
     * @param string $path      Path to the "hlasinek" file
	 */
	public function handleDelete($path)
	{
        $params = $this->context->parameters;
		unlink($this->context->parameters['wwwDir'] . $params['hlasinekStorage'] . $path);
		$this->flashMessage('Soubor byl smazán.');
		$this->redirect('this');
	}

    /**
     * From for adding a new folder
     *
	 * @Action("default")
     * @Privilege("delete")
	 */
	protected function createComponentAddFolderForm()
	{
        $folders = $this->loadFolders();
		$end = $folders['0'] + 10001; //hack shift by 1 school year
		$start = end($folders) - 10001; //hack shift by 1 school year

		$form = new Form;
		$form->addSelect('foldername', 'Přidat složku pro nový šk rok:', [
			$end => mb_substr($end, 0, 4) . '/' . mb_substr($end, 4, 8),
			$start => mb_substr($start, 0, 4) . '/' . mb_substr($start, 4, 8)
	 		])
			->setPrompt('Vyberte složku')
			->setRequired('Vyberte jméno složky.');
		$form->addSubmit('send', 'Přidat');
		$form->onSuccess[] = $this->addFolderFormSucceded;

		$renderer = $form->getRenderer();
		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = NULL;
		$renderer->wrappers['control']['container'] = NULL;
		$renderer->wrappers['label']['container'] = NULL;
		return $form;
	}

    /**
     * Processing of Add Folder form
     *
     * @Privilege("delete")
     *
     * @param Form $form
     */
    public function addFolderFormSucceded(Form $form)
	{
        $params = $this->context->parameters;
		mkdir($params['wwwDir'] . $params['hlasinekStorage'] . '/' . $form->values['foldername']);
		$this->flashMessage('Složka ' . $form->values['foldername'] . ' byla přidána.');
		$this->redirect('this');
	}

    /**
     * Form for adding "Hlásínek" for a particular month
     *
     * @Action("addall")
     * @Privilege("addall")
     */
    protected function createComponentAddHlasinekForm()
    {
        $form = new Form;
        $form->addHidden('folder');
        $form->addHidden('month_number');
        $form->addUpload('01gif', 'Náhled první stránky:')
            ->addCondition(Form::FILLED)
            ->addRule(Form::IMAGE, 'Náhled musí být JPEG, PNG nebo GIF.');
        $form->addUpload('01pdf', 'PDF první stránky:')
            ->addCondition(Form::FILLED)
            ->addRule(Form::MIME_TYPE, 'Musí se jednat o PDF dokument', 'application/pdf');
        $form->addUpload('02gif', 'Náhled druhé stránky:')
            ->addCondition(Form::FILLED)
            ->addRule(Form::IMAGE, 'Náhled musí být JPEG, PNG nebo GIF.');
        $form->addUpload('02pdf', 'PDF druhé stránky:')
            ->addCondition(Form::FILLED)
            ->addRule(Form::MIME_TYPE, 'Musí se jednat o PDF dokument', 'application/pdf');
        $form->addSubmit('send', 'Přidat Hlásínek');
        $form->onSuccess[] = $this->addHlasinekFormSucceded;
        return $form;
    }

    /**
     * Processing of Add Hlasinek Form
     *
     * @Privilege("addall")
     *
     * @param Form $form
     */
    public function addHlasinekFormSucceded(Form $form)
    {
        $values = $form->getValues(TRUE);
        $folder = $values['folder'];
        unset($values['folder']);
        $month_number = $values['month_number'];
	unset($values['month_number']);
	unset($values['send']);
        $params = $this->context->parameters;
        $path = $params['wwwDir'] . $params['hlasinekStorage'] . '/' . $folder . '/';
        foreach($values as $key => $file){
            if($file->isOk()) //is there a file?
            {
                if($file->isImage()){ //make sure the file will be GIF
                    $image = $file->toImage();
                    $filename = 'hlas' . $month_number . mb_substr($key, 0, 2) . '.gif';
		    $image->save($path . $filename, NULL, \Nette\Image::GIF);
		    $this->flashMessage('Náhled byl úspěšně nahrán.');
                } else {  //file is PDF
                    $filename = 'hlas' . $month_number . mb_substr($key, 0, 2) . '.' .  mb_substr($key, 2, 5);
		    $file->move($path . $filename);
		    $this->flashMessage('Dokument byl úspěšně nahrán.');
                }
	    } else {
		if ($file->getError() != 4) { //no file was selected - not an error
		    $form->addError('Soubor se nepodařilo nahrát. Důvod: ' . $file->getError());
		}
	    }
	}

        if (!$form->hasErrors()) $this->redirect('default');
    }

    /**
     * Delete folder form
     *
	 * @Action("default")
     * @Privilege("delete")
	 */
	protected function createComponentDeleteFolderForm()
	{
        $folders = $this->loadFolders();
		$years = $folders;
		$form = new Form;
		array_walk($years, function (&$value) {
			$value = mb_substr($value, 0, 4) . '/' . mb_substr($value, 4, 8);
		});
		$input = array_combine($folders, $years);
		$form->addSelect('foldername', 'Smazat složku pro školní rok:', $input)
			->setPrompt('Vyberte složku')
			->setRequired('Vyberte jméno složky.');
		$form->addSubmit('send', 'Smazat');
		$form->onSuccess[] = $this->deleteFolderFormSucceded;

		$renderer = $form->getRenderer();
       	$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = NULL;
		$renderer->wrappers['control']['container'] = NULL;
		$renderer->wrappers['label']['container'] = NULL;
		return $form;
	}

    /**
     * Processing of Delete folder Form
     *
     * @Privilege("delete")
     *
     * @param Form $form
     */
    public function deleteFolderFormSucceded(Form $form)
	{
        $params = $this->context->parameters;
		$dir = $params['wwwDir'] . $params['hlasinekStorage'] . '/' . $form->values['foldername'];

		//recursive delete a non-empty folder
		$recursive = function ($dir) use (&$recursive){
			foreach(glob($dir . '/*') as $file) {
				if(is_dir($file)) $recursive($file);
			    else unlink($file);
			}
			rmdir($dir);
		};
		$recursive($dir);

		$this->flashMessage('Složka ' . $form->values['foldername'] . ' byla smazána.');
		$this->redirect('this');
	}
}
