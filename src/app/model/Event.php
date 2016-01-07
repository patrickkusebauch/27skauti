<?php
namespace Models;
/**
 * Event model
 *
 * Models the events boy scouts can go on. Starting with scheduling and invitation
 * up to the the point a chronicle from the event is written
 *
 * @author Patrick Kusebauch
 * @version 3.00, 09. 11. 2014
 */
class Event extends Repository
{
    /**
     * Adds photo to chronicle
     *
     * @param int $event_id                             Event to add photos to
     * @param string $order                             Order to display in/name of file
     * @return int                                      Number of affected rows
     */
    public function addChroniclePhoto($event_id, $order) {
        return $this->database->query('INSERT IGNORE INTO chronicle_photos', array(
            'event_id' => $event_id,
            'order' => $order
        ));
    }

    /**
     * Deletes an event
     *
     * Deletes also all information about photos and videos and chronicle
     * Keeps all the photos in the filesystem but not in the database
     *
     * @param int $id               Event ID
     * @return int
     */
    public function deleteEvent($id) {
        $event = $this->get($id);
        $event->related('chronicle_photos')->delete();
        $event->related('chronicle_videos')->delete();
        return $event->delete();
    }

    /**
     * Deletes a chronicle entry (but not the event itself)
     * Keeps all the photos in the filesystem but not in the database
     *
     * @param int $id                                   Event ID
     * @return bool|mixed|\Nette\Database\Table\IRow
     */
    public function deleteChronicle($id) {
        $event = $this->get($id);
        $event->update([
            'chroniclewriter' => NULL,
            'route' => NULL,
            'rangers' => NULL,
            'tucnaci' => NULL,
            'mloci' => NULL,
            'novacci' => NULL,
            'content' => NULL,
            'showchronicle' => 0,
        ]);
        $event->related('chronicle_photos')->delete();
        $event->related('chronicle_videos')->delete();
        return $event;
    }

    /** @var string */
    protected $table = "event";

    /**
     * Get the Collection of events that are yet to finish
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getCurrentEvents() {
        $events = $this->findAll()
            ->where('dateend >= CURDATE()')
            ->where('showevent', 1)
	    ->order('dateend', 'ASC');
	return $events;
    }

    /**
     * Gets event for chronicle overview
     *
     * @param int $year                         The starting year of a school year (2014 for 2014/2015)
     * @return \Nette\Database\Table\Selection
     */
    public function getEventsForChronicle($year) {
        return $this->getEventsFromYear($year)
            ->where('showchronicle', 1)
            ->order('dateend DESC');
    }

    /**
     * Get event from a particular calendar
     *
     * @param int $id                           Calendar ID
     * @return \Nette\Database\Table\Selection
     */
    public function getEventsFromCalendar($id) {
        return $this->findBy(['calendar_id' => $id])
            ->order('dateend ASC');
    }

    /**
     * Gets an event based on a date it started
     * Assumes there cannot be 2 events happening at the same date
     *
     * @param string $datestart                         Starting date of the event
     * @return bool|mixed|\Nette\Database\Table\IRow
     */
    public function getEventFromDatestart($datestart) {
        return $this->getBy(['datestart' => $datestart]);
    }

    /**
     * Gets events from a chosen school year
     *
     * @param int $year                         The starting year of a school year (2014 for 2014/2015)
     * @return \Nette\Database\Table\Selection
     */
    public function getEventsFromYear($year)
    {
		$years = [['year' => (int) $year, 'yearpart' => 'podzim'],
    		['year' => ($year + 1),	'yearpart' => 'jaro']];
    	$calendar_id = array();
    	foreach ($years as $year) //gets calendar IDs for particular events
    	{
    		$calendar_id = array_merge((array) $calendar_id, (array)
                $this->database->table("calendar")
    			->where('year', $year['year'])
    			->where('yearpart', $year['yearpart'])
    			->fetchPairs('id', 'id'));
		}
		return $this->findBy(['calendar_id' => $calendar_id]);
    }

    /**
     * Get all events that don't have a news post about them
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getEventsWithoutNews(){
        $news = $this->database->table('news')->where([
            'type' => 'Akce',
            'event_id NOT' => NULL,
        ])->fetchPairs('event_id', 'event_id');
        return $this->findAll()
            ->where('showevent', [1])
	    ->where('NOT (id ?)', array_values($news))
	    ->where('dateend >= DATE_SUB(NOW(), INTERVAL 12 MONTH)')
            ->order('dateend DESC');
    }

    /**
     * Particular image from a chronicle
     *
     * @param int $chornicle_id                         ID of the chronicle
     * @param int $image_id                             order/filename of the image
     * @return bool|mixed|\Nette\Database\Table\IRow
     */
    public function getChronicleImage($chornicle_id, $image_id) {
        $images = $this->get($chornicle_id)->related("chronicle_photos");
        return $images->where("order", $image_id)->fetch();
    }

    /**
     * All the images from a chronicle
     *
     * @param int $chornicle_id                         ID of the chronicle
     * @return \Nette\Database\Table\GroupedSelection
     */
    public function getChronicleImages($chornicle_id) {
        return $this->get($chornicle_id)->related("chronicle_photos");
    }

    /**
     * Gets all videos related to certain chronicle
     *
     * @param int $id                                   Event ID
     * @return \Nette\Database\Table\GroupedSelection   Collection of videos related to chronicle
     */
    public function getChronicleVideos($id) {
        return $this->get($id)
            ->related('chronicle_videos');
    }

    /**
     * Get all chronicles that don't have a news post about them
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getChroniclesWithoutNews(){
        $news = $this->database->table('news')->where([
            'type' => 'Kronika',
            'event_id NOT' => NULL,
        ])->fetchPairs('event_id', 'event_id');
        return $this->findAll()
            ->where('showchronicle', [1])
            ->where('NOT (id ?)', array_values($news))
	    ->where('dateend >= DATE_SUB(NOW(), INTERVAL 12 MONTH)')
            ->order('dateend DESC');
    }

    /**
     * Get major events from year like "Výprava" and "Vícedeňka"
     *
     * @param int $year                         The starting year of a school year (2014 for 2014/2015)
     * @return \Nette\Database\Table\Selection
     */
    public function getMajorEventsFromYear($year) {
        return $this->getEventsFromYear($year)
            ->where('type <>', 'Schůzka')
            ->where('type <>', 'Družinovka');
    }

    /**
     * Looks for the newest chronicle allowed to be displayed
     *
     * @return bool|mixed|\Nette\Database\Table\IRow
     */
    public function getNewestChronicle()
    {
    	return $this
            ->findBy(['showchronicle' => 1])
			->order('dateend DESC')
			->limit(1)
    		->fetch();
    }

    /**
     * Gets events from year ordered by the date they ended
     *
     * @param int $year                         The starting year of a school year (2014 for 2014/2015)
     * @return \Nette\Database\Table\Selection
     */
    public function getOrderedEventsFromYear($year) {
        return $this->getEventsFromYear($year)
            ->order('dateend ASC');
    }

    /**
     * Do you want to show the event invitation for particular event
     *
     * @param int $id                                   Event ID
     * @param bool|NULL $show                           Do you want to show the event (NULL for flip from current state)
     * @return bool|mixed|\Nette\Database\Table\IRow
     * @throws \Nette\InvalidArgumentException          If $show is not bool/NULL
     */
    public function showEventInvitation($id, $show = NULL) {
        $event = $this->get($id);
        if((($event->showevent == 1) && ($show === NULL)) || $show === FALSE) {
            $event->update(['showevent' => 0]);
	    $event->related('news')->where('type', 'Akce')->update(['show' => 0]);
	} elseif((($event->showevent == 0) && ($show === NULL)) || $show === TRUE) {
            $event->update(['showevent' => 1]);
	    $event->related('news')->where('type', 'Akce')->update(['show' => 1]);
        } else {
            throw new \Nette\InvalidArgumentException("Second argument of showEventInvitation must be a bool|NULL, '$show' given");
        }
        return $event;
    }

    /**
     * Do you want to show the chornicle for particular event
     *
     * @param int $id                                   Event ID
     * @param bool|NULL $show                           Do you want to show the chronicle (NULL for flip from current state)
     * @return bool|mixed|\Nette\Database\Table\IRow
     * @throws \Nette\InvalidArgumentException          If $show is not bool/NULL
     */
    public function showChronicle($id, $show = NULL) {
        $event = $this->get($id);
        if((($event->showchronicle == 1) && ($show === NULL)) || $show === FALSE) {
            $event->update(['showchronicle' => 0]);
	    $event->related('news')->where('type', 'Kronika')->update(['show' => 0]);
        } elseif((($event->showchronicle == 0) && ($show === NULL)) || $show === TRUE) {
            $event->update(['showchronicle' => 1]);
	    $event->related('news')->where('type', 'Kronika')->update(['show' => 1]);
        } else {
            throw new \Nette\InvalidArgumentException("Second argument of showChronicle must be a bool|NULL, '$show' given");
        }
        return $event;
    }
}
