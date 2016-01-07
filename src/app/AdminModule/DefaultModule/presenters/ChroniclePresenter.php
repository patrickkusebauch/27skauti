<?php
namespace AdminModule\DefaultModule;
use \Nette\Application\UI\Form,
    \Nette\Utils\Finder,
    \Nette\Forms\Container;
/**
 * Alterations of chronicles
 *
 * @author Patrick Kusebauch
 * @version 3.10, 09. 11. 2014
 *
 * @Secured
 * @Resource("Admin:Default:Chronicle")
 */
class ChroniclePresenter extends BasePresenter
{

    /** @var \Models\Event */
    protected $events;

    /** @var \Nette\Database\Context */
    private $database;

    /** @var  \Models\Member */
    protected $members;

    /**
     * Connect to the database by DI
     * Required for access to following tables:
     *  - chronicle_photos
     *  - chronicle_videos
     *
     * @param \Nette\Database\Context $database
     */
    public function __construct(\Nette\Database\Context $database)
    {
        $this->database = $database;
    }

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
     * Shortcut for loading single item
     *
     * @param int $id                               Event ID
     * @return \Nette\Database\Table\ActiveRow      Single event with chosen ID if it exist
     */
    protected function loadItem($id)
    {
        $item = $this->events->get($id);
        if (!$item) {
            $this->flashMessage('Vybraná kronika neexistuje', 'error');
            $this->redirect('default');
        }
        return $item;
    }

    /**
     * Edit of a single chronicle entry
     *
     * @Privilege("edit")
     *
     * @param int $id           Event ID
     */
    public function actionEdit($id)
    {
        $event = $this->loadItem($id);
        $defaults = $event->toArray();
        $this['editChronicleForm']->setDefaults($defaults);
        $this->template->event = $event;
    }

    /**
     * Fix the discrepancy between filesystem and database
     * in regard to photos. Since it can delete/alter results,
     * deleting privileges are required.
     *
     * @Privilege("delete")
     */
    public function actionFixPhotos(){}

    /**
     * Generating photos for a chronicle
     * Allows for uploading photos to any event
     * This action means partial access to file system,
     * so it is guarded by high privileges
     *
     * @Privilege('generate')
     *
     * @param int $id               Event ID
     */
    public function actionGenerate($id)
    {
        $event = $this->loadItem($id);
        $this['uploadPhotosForm']['id']->setValue($event->id);
        $this->template->event = $event;
    }

    /**
     * Allows for labeling the photos for chronicle if any exist
     * Does not allow to change anything else about the event and
     * automatically hides after any edit if user does not have
     * the privileges to re-display the event
     *
     * @Privilege('photos')
     *
     * @param int $id               Event ID
     */
    public function actionPhotos($id)
    {
        $event = $this->loadItem($id);
        $calendar = $event->ref('calendar');
        $year = ($calendar->yearpart === 'podzim') ? $calendar->year : $calendar->year - 1;
        $date = substr($event->datestart, 0, 4) . substr($event->datestart, 5, 2) . substr($event->datestart, 8, 2);
        $dirpath = $this->context->parameters['chroniclePhotosStorage'] . '/' . $year . ($year + 1) . '/' . $date;
        $photos = $event->related('chronicle_photos');
        $this['labelPhotosForm']->setValues($event);
        $this['labelPhotosForm']['chronicle_photos']->setDefaults($photos);
        $this->template->dirPath = $dirpath;
        $this->template->photos = $photos->fetchPairs('id', 'order');
        $this->template->event = $event;
    }

    /**
     * Allows for labeling the videos of chronicle if any exist
     * Does not allow to change anything else about the event and
     * automatically hides after any edit if user does not have
     * the privileges to re-display the event
     *
     * @Privilege('videos')
     *
     * @param int $id               Event ID
     */
    public function actionVideos($id)
    {
        $event = $this->loadItem($id);
        $videos = $event->related('chronicle_videos');
        $this['labelVideosForm']->setDefaults($event);
        $this['labelVideosForm']['chronicle_videos']->setDefaults($videos);
        $this->template->event = $event;
    }

    /**
     * Overview of all chronicles
     *
     * @Privilege("default")
     */
    public function renderDefault()
    {
        $vp = new \VisualPaginator($this, 'vp');
        $vp->short = FALSE; //display full list
        $vp->setTemplate('template-schoolyear.phtml');
        $paginator = $vp->getPaginator();
        $year = (idate("m") < 8) ? idate("Y") - 1 : idate("Y");
        $paginator->setBase($this->context->parameters["baseChronicleYear"]);
        $page = $vp->page ? $vp->page : $year;
        $paginator->setItemCount($year - $paginator->getBase() + 1);
        $paginator->setItemsPerPage(1);
        $paginator->setPage($page);

        $template = $this->template;
        $template->events = $this->events->getOrderedEventsFromYear($page);
    }

    /**
     * Deletes chronicle (but not the Event) of you have the privileges
     *
     * @Privilege("delete")
     *
     * @param int $id               Event ID
     */
    public function handleDelete($id)
    {
        $this->events->deleteChronicle($id);
        $this->flashMessage("Kronika byla vymazána");
        $this->redirect('Chronicle:');
    }

    /**
     * Redraws the form based on inputted values
     */
    public function handleRedrawForm()
    {
        $this->invalidateControl("form");
    }

    /**
     * (Dis)allows chronicle for viewing
     *
     * @Privilege("show")
     *
     * @param int $id           Event ID
     */
    public function handleShow($id)
    {
        $event = $this->events->showChronicle($id);
        if ($event->showchronicle) {
            $this->flashMessage("Kronika byla zobrazena");
        } else {
            $this->flashMessage("Kronika byla odzobrazena");
        }
        $this->redirect('Chronicle:');
    }

    /**
     * Form for inputting information about the event to form chronicle
     * Can only be accessed by user with editing privileges and only in "edit" action
     *
     * @Privilege("edit")
     * @Action("edit")
     */
    protected function createComponentEditChronicleForm()
    {
        $form = new Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addHidden('id');
	    $form->addText('name', 'Název akce');
	    $form->addTextarea('rangers', 'Vedení a roveři');
        $form->addTextarea('mloci', 'Mloci:');
        $form->addTextarea('tucnaci', 'Tučňáci:');
        $form->addTextarea('novacci', 'Nováčci:');
        $form->addTextarea('route', 'Trasa:');
        $form->addTextarea('content', 'Zápis do kroniky:');
        $writers = $this->members->findAll()->fetchPairs('nickname', 'nickname');
        $form->addSelect('chroniclewriter', 'Zapsal do kroniky:', $writers)
            ->setRequired('Musíte vybrat, kdo zapsal akci do kroniky')
            ->setPrompt('Vyberte člena');
        if ($this->user->isAllowed('Admin:Default:Chronicle', 'show')) {
            $form->addCheckbox('showchronicle', 'Zobrazit kroniku:')
                ->setDefaultValue(TRUE);
        }
        $form->addSubmit('send', 'Upravit');
        $form->onSuccess[] = $this->editChronicleFormSucceded;
        return $form;
    }

    /**
     * Processing of Chronicle Form
     *
     * @Privilege("edit")
     *
     * @param Form $form
     */
    public function editChronicleFormSucceded(Form $form)
    {
        $values = $form->getValues(TRUE);
        if ($this->user->isAllowed('Admin:Default:Chronicle', 'show')) { //User can choose
            $values['showchronicle'] = $values['showchronicle'] ? 1 : 0; //translate TRUE/FALSE to 1/0
        } else {
            $values['showchronicle'] = 0; //default value
        }
        $this->events->get($values['id'])->update($values);
        $this->flashMessage('Kronika byla úspěšně upravena.');
        $this->redirect('default');
    }

    /**
     * Form for fixing the discrepancies between the filesystem and database
     *
     * @Action("fixPhotos")
     * @Privilege("delete")
     *
     * @return Form
     */
    protected function createComponentFixPhotosForm()
    {
        $params = $this->context->parameters;
        $form = new Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $folders = scandir($params['wwwDir'] . $params['chroniclePhotosStorage'], SCANDIR_SORT_DESCENDING);
        array_pop($folders); // ".."
        array_pop($folders); // "."
        $form->addSelect('folder', 'Opravit fotky pro rok:', array_combine($folders, $folders))
            ->setRequired('Musíte vybrat složku s rokem, pro který chcete opravit fotky.')
            ->setPrompt('Vyberte složku/rok');
        $form->addSubmit('send', 'Opravit');
        $form->onSuccess[] = $this->fixPhotosFormSucceded;
        return $form;
    }

    /**
     * Processing of the Form to fix photos
     *
     * @Privilege("delete")
     *
     * @param Form $form
     */
    public function fixPhotosFormSucceded(Form $form)
    {
        $params = $this->context->parameters;
        $folder = $form->getValues()->folder;
        $dir = $params['wwwDir'] . $params['chroniclePhotosStorage'] . '/' . $folder;
        if (!is_dir($dir)) {
            $form->addError('Nejedná se o složku');
        } else {
            foreach (Finder::findFiles('*.jpg')->from($dir) as $path => $file) {
                $names = explode($folder, $path);
                $date = substr($names[1], 1, 8);
                $order = substr($names[1], 10, 4);
                $chronicle = $this->events->getEventFromDatestart($date);
                if(!$chronicle) continue;
                $change = $this->events->addChroniclePhoto($chronicle->id, $order);
                if ($change) $this->flashMessage('Byl vytvořen záznam pro foto ' . $names[1]);
            }
            $this->flashMessage('Oprava fotek byla dokončena.');
            $this->redirect('default');
        }
    }

    /**
     * Form for labeling photos of an event
     * Can only be creating in photos action and accessed by
     * somebody with photos or higher privileges
     *
     * @Privilege('photos')
     * @Action('photos')
     */
    protected function createComponentLabelPhotosForm()
    {
        $form = new Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addHidden('id');
        $form->addDynamic('chronicle_photos', function (Container $container) {
            $container->addHidden('id');
            $container->addTextarea('text')
                ->setAttribute('rows', 4)
                ->setAttribute('cols', 40);
            $container->addCheckbox('intro', NULL, []);

        });
        if ($this->user->isAllowed('Admin:Default:Chronicle', 'show')) {
            $form->addCheckbox('showchronicle', 'Zobrazit kroniku:')
                ->setDefaultValue(TRUE);
        }
        $form->addSubmit('send', 'Přidat popisky')
            ->onClick[] = $this->labelPhotosFormSucceded;
        return $form;
    }

    /**
     * Processing of Photos labeling Form
     *
     * @Privilege('photos')
     *
     * @param $button
     */
    public function labelPhotosFormSucceded($button)
    {
        $form = $button->form;
        $values = $form->getValues(TRUE);
        //update chronicle_photos
        foreach ($form['chronicle_photos']->getValues(TRUE) as $photo) {
            $photo['intro'] = $photo['intro'] ? 1 : 0; //translate TRUE/FALSE to 1/0
            $this->database->table('chronicle_photos')->get($photo['id'])->update($photo);
        }
        //change event visibility
        if (!array_key_exists('showchronicle', $values)) { //user did not have the sufficient permission
            $showchronicle = FALSE;
        } else {
            $showchronicle = $values['showchronicle'] ? TRUE : FALSE;
        }

        $this->events->showChronicle($values['id'], $showchronicle);
        $this->flashMessage('Popisky byly úspěšně přidány.');
        $this->redirect('default');
    }

    /**
     * Form for labeling videos of an event
     * Can only be creating in videos action and accessed by
     * somebody with videos or higher privileges
     *
     * @Privilege('videos')
     * @Action('videos')
     */
    protected function createComponentLabelVideosForm()
    {
        $form = new Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addHidden('id');
        $form->addDynamic('chronicle_videos', function (Container $container) {
            $container->addHidden('id');
            $container->addTextarea('note', 'Nadpis/popisek videa:');
            $container->addTextarea('input', 'HTML Kód pro zobrazení videa:');
            $container->addSubmit('remove', 'Odebrat video')
                ->setValidationScope(FALSE)
                ->addRemoveOnClick();
            //intentional, delete after whole form submit
        }, 1)
            ->addSubmit('add', 'Přídat další video')
            ->setValidationScope(FALSE)
            ->addCreateOnClick(TRUE);
        if ($this->user->isAllowed('Admin:Default:Chronicle', 'show')) {
            $form->addCheckbox('showchronicle', 'Zobrazit kroniku:')
                ->setDefaultValue(TRUE);
        }
        $form->addSubmit('send', 'Odeslat')
            ->onClick[] = $this->labelVideosFormSucceded;
        return $form;
    }

    /**
     * Processing of Videos labelling Form
     *
     * @Privilege('videos')
     *
     * @param $button
     */
    public function labelVideosFormSucceded($button)
    {
        $form = $button->form;
        $values = $form->getValues(TRUE);
        $videoStorage = $this->events->getChronicleVideos($values['id']);
        $videoStorage->delete();
        foreach ($form['chronicle_videos']->getValues(TRUE) as $video) {
            $video = array_filter($video, 'strlen'); //delete empty values
            if (empty($video)) continue; //no user input row
            $video['event_id'] = $form->getValues()->id;
            $videoStorage->insert($video);
        }

        //change event visibility
        if (!array_key_exists('showchronicle', $values)) { //user did not have the sufficient permission
            $showchronicle = FALSE;
        } else {
            $showchronicle = $values['showchronicle'] ? TRUE : FALSE;
        }
        $this->events->showChronicle($values['id'], $showchronicle);
        $this->flashMessage('Videa ke kronice byla úspěčně editována.');
        $this->redirect('default');
    }

    /**
     * Form for uploading photos
     * Can only be created on the Generate action page and accessed
     * by somebody with generate privileges or higher
     *
     * @Privilege('generate')
     * @Action('generate')
     */
    protected function createComponentUploadPhotosForm()
    {
        $form = new Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->getElementPrototype()->class[] = "ajax";

        $form->addHidden('id');
        $form->addMultipleFileUpload("upload", "Fotky:")
            ->addRule("MultipleFileUpload::validateFilled", "Musíte odeslat alespoň jeden soubor!")
            ->addRule("MultipleFileUpload::validateFileSize", "Soubory jsou dohromady moc veliké!", 100 * 1024 * 1024);
        //100MiB

        if ($this->user->isAllowed('Admin:Default:Chronicle', 'show')) {
            $form->addCheckbox('showchronicle', 'Zobrazit kroniku')
                ->setDefaultValue(TRUE);
        }
        $form->addSubmit("send", "Odeslat");
        $form->onSuccess[] = $this->uploadPhotosFormSucceded;

        // snippet invalidation
        $form->onError[] = $this->handleRedrawForm;
        $form->onSuccess[] = $this->handleRedrawForm;
        return $form;
    }

    /**
     * Processing of Upload Photos Form
     *
     * @Privilege('generate')
     *
     * @param Form $form
     */
    public function uploadPhotosFormSucceded(Form $form)
    {
        $values = $form->getValues();
        $event = $this->loadItem($values['id']);
        $calendar = $event->ref('calendar');
        $year = ($calendar->yearpart === 'podzim') ? $calendar->year : $calendar->year - 1;
        $date = substr($event->datestart, 0, 4) . substr($event->datestart, 5, 2) . substr($event->datestart, 8, 2);

        // check if the year dir exist. if not, create one
        $params = $this->context->parameters;
        $dirYear = $params['wwwDir'] . $params['chroniclePhotosStorage'] . '/' . $year . ($year + 1) . '/';
        // check if the event dir exists. if not, create one
        $dir = $dirYear . $date . '/';
        if (!file_exists($dir)) mkdir($dir, 0777, TRUE);
        \Tracy\Debugger::barDump($dir);

        // start uploading files
        $counter = 0;
        foreach ($values['upload'] as $file) {
            if ($file->isOK()) {
                if ($file->isImage()) {
                    do {
                        $counter += 1; //increment counter until you hit empty space for file
                        $filePath = $dir . \Nette\Utils\Strings::padLeft($counter, 4, '0') . '.jpg';
                    } while (file_exists($filePath));
                    $image = $file->toImage();
                    $image->save($filePath, 85, \Nette\Image::JPEG);
                    $this->database->table('chronicle_photos')
                        ->insert([
                            'event_id' => $values['id'],
                            'order' => $counter //leftpad by database (zerofill)
                        ]);
                    $this->flashMessage("Soubor " . $file->getName() . " byl úspěšně nahrán!");
                } else {
                    $form->addError('Soubor' . $file->getName() . ' nebyl rozpoznán jako fotka.');
                }

            } else {
                $form->addError('Nepodařilo se nahrát soubor:' . $file->getName());
            }
        }
        //change event visibility
        if (!array_key_exists('showchronicle', $values)) { //user did not have the sufficient permission
            $showchronicle = FALSE;
        } else {
            $showchronicle = $values['showchronicle'] ? TRUE : FALSE;
        }

        $this->events->showChronicle($values['id'], $showchronicle);
        if (!$form->hasErrors()) $this->redirect('default');
    }

}
