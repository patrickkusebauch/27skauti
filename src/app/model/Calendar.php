<?php
namespace Models;
/**
 * Calendar model
 * 
 * Represents the calendar used for scheduling events
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
class Calendar extends Repository
{
    /** @var string */
    protected $table = "calendar";

    /**
     * Gets all calendars in descending order
     *
     * @return \Nette\Database\Table\Selection
     */
    public function descendingOrder() {
        return $this->findAll()
            ->order('year DESC')
            ->order('yearpart DESC');
    }

    /**
     * Gets a individual calendar from a period
     *
     * @param int $year                                 Year of the calendar
     * @param string $yearpart                          "jaro"|"podzim"
     * @return FALSE|\Nette\Database\Table\ActiveRow
     */
    public function getCalendar($year, $yearpart) {
        return $this->getBy([
            'year' => $year,
            'yearpart' => $yearpart,
        ]);
    }

    /**
     * Gets Collection of calnedars that are set for viewing
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getVisibleCalendars() {
    	return $this->findBy(['show' => 1])
			->order('year ASC')
			->order('yearpart ASC');
    }

    /**
     * Do you want to show the calendar
     *
     * @param int $id                           Calendar ID
     * @param bool|NULL $show                   Do you want to show the calendar (NULL for flip from current state)
     * @return \Nette\Database\Table\ActiveRow  Affected row
     * @throws \Nette\InvalidArgumentException  if $show is not bool/NULL
     */
    public function showCalendar($id, $show = NULL) {
        $calendar = $this->get($id);
        if((($calendar->show == 1) && ($show === NULL)) || $show === FALSE) {
            $calendar->update(['show' => 0]);
        } elseif((($calendar->show == 0) && ($show === NULL)) || $show === TRUE) {
            $calendar->update(['show' => 1]);
        } else {
            throw new \Nette\InvalidArgumentException("Second argument of showCalendar must be a bool|NULL, '$show' given");
        }
        return $calendar;
    }
}
