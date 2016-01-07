<?php
namespace FrontModule\DefaultModule;

/**
 * Presents the news, new events and the calendar for this site
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
class NewsPresenter extends BasePresenter
{
    /** @var \Models\Calendar */
    protected $calendars;

    /** @var \Models\Event */
    protected $events;

    /** @var  \Models\News */
    protected $news;

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
     * Sets variables for view of "Archiv" page
     */
    public function renderArchive()
    {
        $news = $this->news->getAll();
        $vp = new \VisualPaginator($this, 'vp');
        $page = $vp->page;
        $paginator = $vp->getPaginator();
        $paginator->setItemCount($news->count());
        $paginator->setItemsPerPage(5);
        $paginator->setPage($page);

        $template = $this->template;
        $template->title = "Archiv aktualit";
        $template->news = $news
            ->limit($paginator->getLength(), $paginator->getOffset());
    }

    /**
     * Sets variables for view of "Akce" page
     */
    public function renderDefault()
    {
        $template = $this->template;
        $template->title = "Akce";
        $template->events = $this->events->getCurrentEvents();
        $template->calendars = $this->calendars->getVisibleCalendars();
    }

    /**
	 * Sets variables for view of "Aktuality" page
	 */
	public function renderNews()
	{
        $template = $this->template;
        $template->title = "Aktuality";
		$template->news = $this->news->getNewest(10);
	}


	/**
	 * Creates the Submenu
     *
	 * @param String $name
	 */
	protected function createComponentSubmenu($name) {
	    $nav = new \Navigation\Navigation($this, $name);
	    $nav->setMenuTemplate('submenu.latte');
    		$nav->add("Aktuality", "News:news");
    		$nav->add("Akce", "News:");
    		$nav->add("Archiv", "News:archive");
	}

}
