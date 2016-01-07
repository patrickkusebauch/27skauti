<?php
namespace AdminModule\DefaultModule;
use \Nette\Application\UI\Form,
	\Nette\Forms\Container;
/**
 * Operations over calendar and event invitations
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 *
 * @Secured
 * @Resource("Admin:Default:Event")
 */
class EventPresenter extends BasePresenter
{
    /** @var \Models\Calendar */
    protected $calendars;

    /** @var \Nette\Database\Context */
    private $database;

    /** @var \Models\Event */
    protected $events;

    /** @var  \Models\Member */
    protected $members;

    /** @var  \Models\Registration */
    protected $registrations;

    /**
     * Connects to the database by DI
     *
     * @param \Nette\Database\Context $database
     */
    public function __construct(\Nette\Database\Context $database)
	{
		$this->database = $database;
	}

    /**
     * Injects connection to calendar model
     *
     * @param \Models\Calendar $calendar
     * @throws \Nette\InvalidStateException
     */
    public function injectCalendar(\Models\Calendar $calendar){
        if ($this->calendars) {
            throw new \Nette\InvalidStateException('Calendar has already been set');
        }
        $this->calendars = $calendar;
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
     * Shortcut for loading single Event
     *
     * @param int $id                                   Event ID
     * @return \Nette\Database\Table\ActiveRow      Single event with chosen ID if it exist
     */
    protected function loadEvent($id)
    {
        $item = $this->events->get($id);
        if (!$item) {
            $this->flashMessage('Akce s ID ' . $id . ' neexistuje.', 'error');
            $this->redirect('default');
        }
        return $item;
    }

    /**
     * Adding a new nonexistent calendar
     *
     * @Privilege("createcalendar")
     */
    public function actionCreateCalendar(){}

    /**
     * Edit individual invitation to an event
     *
     * @Privilege("edit")
     *
     * @param int $id           Event ID
	 */
	public function actionEdit($id)
	{
		$item = $this->loadEvent($id);
		$form = $this['editEventForm'];
		$form->setDefaults($item);
		if(!$item->contactperson){
			$member = $this->members->getBy(['user_id' => $this->user->id]);
			if($member && in_array($member->nickname, $form['contactperson']->getItems(), TRUE)){
				$form['contactperson']->setDefaultValue($member->nickname);
			}
		}
		$form['event_meeting']->setDefaults($item->related('event_meeting')->fetchPairs('event_id'));
	}

    /**
     * Editation of already created calendar based on it's ID
     *
     * @Privilege("editcalendar")
     *
     * @param int $id               Calendar ID
     */
    public function actionEditCalendar($id)
    {
        $calendar = $this->calendars->get($id);
        if(!$calendar) {
            $this->flashMessage('Vybraný kalendář neexistuje.', 'error');
            $this->redirect('default');
        }
        $events = $this->events->getEventsFromCalendar($id);
        $form = $this['editCalendarForm'];
        $form['calendar_id']->setValue($id);
        $form['events']->setDefaults($events);

        $this->template->calendar = $calendar;
    }

    /**
     * Calendar and Event invitation overview
     *
     * @Privilege("default")
     */
    public function renderDefault()
    {
        $vp = new \VisualPaginator($this, 'vp');
        $vp->short = FALSE;
        $vp->setTemplate('template-schoolyear.phtml');
        $paginator = $vp->getPaginator();
        $year = (idate("m")<8) ? idate("Y")-1 :idate("Y"); //school year starts in August
        $paginator->setBase($this->context->parameters['baseEventYear']);
        $page = $vp->page ? $vp->page : $year;
        $paginator->setItemCount($year-$paginator->getBase()+1);
        $paginator->setItemsPerPage(1);
        $paginator->setPage($page);

        $template = $this->template;
        $template->events = $this->events->getMajorEventsFromYear($page)
            ->order('dateend ASC');
        $template->calendars = $this->calendars->descendingOrder();
    }

    /**
     * Deletes an event based on its ID
     *
     * Will delete every mention of it, namely:
     *  - calendar entry
     *  - event invitation
     *  - chronicle from event
     *  - videos from chronicle
     *  - comments of photos from chronicle (however the photos stay on filesystem)
     *
     * @Privilege("delete")
     *
     * @param int $id           Event ID
     */
    public function handleDelete($id) {
        $this->events->deleteEvent($id);
        $this->flashMessage("Akce byla smazána");
        $this->redirect('Event:');
    }

    /**
     * (Dis)allows event invitation for viewing
     *
     * @Privilege("show")
     *
     * @param int $id       Event ID
     */
    public function handleShow($id)
    {
        $event = $this->events->showEventInvitation($id);
        if($event->showevent) {
            $this->flashMessage("Lísteček na akci byl zobrazen");
        } else {
            $this->flashMessage("Lísteček na akci byl odzobrazen");
        }
        $this->redirect('this');
    }

    /**
     * (Dis)allows calendars for viewing
     *
     * @Privilege("showcalendar")
     *
     * @param int $id               Calendar ID
     */
    public function handleShowCalendar($id)
    {
        $calendar = $this->calendars->showCalendar($id);
        if($calendar->show) {
            $this->flashMessage("Kalendář byl zobrazen");
        } else {
            $this->flashMessage("Kalendář byl odzobrazen");
        }
        $this->redirect('Event:');
    }

    /**
     * Form for adding a calendar
     *
	 * @Action("createcalendar")
     * @Privilege("createcalendar")
	 */
	protected function createComponentAddCalendarForm()
	{
		$form = new Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addText('year', 'Rok:')
			->setRequired('Vložte rok');
		$form->addSelect('yearpart', 'Období:', array(
			'jaro' => 'jaro',
			'podzim' => 'podzim'))
			->setPrompt('Vyberte období')
			->setRequired('Vyberte období');
		$form->addSubmit('send', 'Přidat');
		$form->onSuccess[] = $this->addCalendarFormSucceded;

		//rendering
		$renderer = $form->getRenderer();
		$renderer->wrappers['controls']['container'] = 'div';
		$renderer->wrappers['pair']['container'] = NULL;
		$renderer->wrappers['control']['container'] = NULL;
		$renderer->wrappers['label']['container'] = NULL;
		return $form;
	}

    /**
     * Processing of Add calendar Form
     *
     * @Privilege("createcalendar")
     *
     * @param Form $form
     */
    public function addCalendarFormSucceded(Form $form)
	{
		$values = $form->getValues(TRUE);
		unset($values['send']);
		if($this->calendars->getCalendar($values['year'], $values['yearpart'])
            ) { //intentionally not form error, since they have what they need
				$this->flashMessage("Kalendář pro " . $values['yearpart'] . " " . $values['year'] . " už existuje.");
		} else {
			$this->calendars->insert($values);
			$this->flashMessage("Kalednář byl úspěšně přídán");
		}
		$this->redirect('Event:');
	}

    /**
     * Form for editing a calendar
     *
     * Basically it works for populating as well,
     * since it means to edit an empty calendar
     *
	 * @Action("editcalendar")
     * @Privilege("editcalendar")
	 */
	protected function createComponentEditCalendarForm()
	{
		$form = new Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addHidden('calendar_id');
		$events = $form->addDynamic('events', function(Container $container) {
			$container->addHidden('id');
			$container->addDatePicker('datestart')
				->setRequired('Vyberte, kdy akce začala.');
			$container->addDatePicker('dateend')
				->setRequired('Vyberte, kdy akce skončila.');
			$container->addSelect('type', NULL, [
				'Schůzka' => 'Schůzka',
				'Výprava' => 'Výprava',
				'Družinovka' => 'Družinovka',
				'Vícedeňka' => 'Vícedeňka',
				'VIP' => 'VIP',
				'Tábor' => 'Tábor'])
				->setRequired('Vyberte typ akce.')
				->setPrompt('Typ akce');
			$container->addText('calendarnote')
				->setAttribute('size', 30);
			$container->addText('leaders')
				->setRequired('Vyplňte vedení akce.');
			$container->addSubmit('remove', 'X')
				->setValidationScope(FALSE)
				->addRemoveOnClick(function (\Kdyby\Replicator\Container $replicator, Container $container) {
					if($container['id']->value) {
						$replicator->form->presenter->events->deleteEvent($container['id']->value);
						$replicator->form->presenter->flashMessage("Akce byla smazána");
					}
			});
		}, 1);
		$events->addSubmit('add', 'Přidat záznam')
			->setValidationScope(FALSE)
			->addCreateOnClick(TRUE);

		$form->addSubmit('send', 'Zpracovat')
            ->setValidationScope(FALSE)
            ->onClick[] = $this->editCalendarFormSucceded;

		return $form;
	}

    /**
     * Processing of Edit Calendar form
     *
     * @Privilege("editcalendar")
     *
     * @param $button
     */
    public function editCalendarFormSucceded($button)
	{
		$form = $button->form;
        $events = [];
		foreach ($form['events']->getValues(TRUE) as $event) {
            $event = array_filter($event, 'strlen'); //delete empty values
            if(empty($event)) continue; //no user input row
            if(!array_key_exists('datestart', $event)) $form->addError('Musíte vyplnit datum srazu.');
            if(!array_key_exists('dateend', $event)) $form->addError('Musíte vyplnit datum návratu.');
	    if(!array_key_exists('type', $event)) $form->adderror('musíte vyplnit typ akce.');
	    if(!array_key_exists('calendarnote', $event)) $event['calendarnote'] = "";
            $events[] = $event;
        }
        if($form->hasErrors() === FALSE) {
            foreach ($events as $event) {
                $event['calendar_id'] = $form->getValues()->calendar_id;
                if(array_key_exists('id', $event)) { //make an update
                    $this->events->get($event['id'])->update($event);
                } else { //make an insert
                    $this->events->insert($event);
                }
            }
            $this->flashMessage('Kalendář byl úspěšně upraven.');
            $this->redirect('default');
        }

	}

    /**
     * Form for editing the invitations to events
     *
     * @Action("edit")
     * @Privilege("edit")
     */
    protected function createComponentEditEventForm()
    {
        $form = new Form;
        $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addHidden('id');
        $form->addText('name', 'Název akce:')
            ->setRequired('Vyplňte název akce');
        $form->addTextarea('text', 'Úvodní text lístečku:')
            ->setRequired('Vyplňte text lístečku')
            ->setAttribute('rows', 5);
        $form->addDynamic('event_meeting', function(Container $container){
            $container->addText('comment', 'Typ srazu:');
            $container->addDateTimePicker('starttime', 'Datum a čas srazu:')
                ->setRequired('Vyplňte čas srazu');
            $container->addText('startplace', 'Místo srazu:')
                ->setRequired('Vyplňte místo srazu');
            $container->addDateTimePicker('endtime', 'Datum a čas návratu:')
                ->setRequired('Vyplňte čas návratu');
            $container->addText('endplace', 'Místo návratu:')
                ->setRequired('Vyplňte místo návratu');
            $container->addSubmit('remove', 'X')
                ->setValidationScope(FALSE)
                ->addRemoveOnClick();//intentional, delete after whole form submit
        }, 1)
            ->addSubmit('add', 'Přidat sraz')
            ->setValidationScope(FALSE)
            ->addCreateOnClick(TRUE);
        $form->addTextarea('equipment', 'S sebou:')
            ->setRequired('Vyplňte co si s sebou vzít na akci')
            ->setAttribute('rows', 5);
        $form->addTextarea('morse', 'Morseovka:')
            ->setAttribute('rows', 5);
        //contact person
        $contacts = $this->registrations
            ->findBy(['member_nickname IS NOT NULL'])
            ->fetchPairs('member_nickname', 'member_nickname');
        $form->addSelect('contactperson', 'Kontaktní osoba:', $contacts)
            ->setRequired('Vyberte kontaktní osobu')
            ->setPrompt('Kontaktní osoba');
        if($this->user->isAllowed('Admin:Default:Event', 'show')){
            $form->addCheckbox('showevent', 'Zobrazit lísteček')
                ->setDefaultValue(TRUE);
        }

        $form->addSubmit('send', 'Změnit');
        $form->onSuccess[] = $this->editEventFormSucceded;
        return $form;
    }

    /**
     * Processing of Event Edit form
     *
     * @Privilege("edit")
     *
     * @param Form $form
     */
    public function editEventFormSucceded(Form $form)
    {
        $values = $form->getValues(TRUE);

        //error checking (multiple meetings with same type)
        $event_meetings = $values['event_meeting'];
        $error = FALSE;
        $meeting_places = [];
        foreach($event_meetings as $meeting){
            if(in_array($meeting['comment'], $meeting_places)) {
                $error = TRUE;
            } else {
                array_push($meeting_places, $meeting['comment']);
            }
        }
        //error checking complete

        if($error) {
            $form->addError('Nemůžete mít dva srazy stejného typu.');
        } else { //form processing
            $meeting = $this->database->table('event_meeting');
            $meeting->where('event_id', $values['id'])->delete();
            foreach($event_meetings as $event_meeting) {
                $event_meeting['event_id'] = $values['id'];
                $meeting->insert($event_meeting);
            }
            unset($values['event_meeting']);
            unset($values['send']);
            if($this->user->isAllowed('Admin:Default:Event', 'show')){ // User can choose
                $values['showevent'] = $values['showevent'] ? 1 : 0; //translate TRUE/FALSE to 1/0
            } else {
                $values['showevent'] = 0; //default value
            }
            $this->events->get($values['id'])->update($values);
            $this->flashMessage('Lísteček byl úspěšně upraven.');
            $this->redirect('default');
        }
    }
}
	
