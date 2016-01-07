<?php
namespace FrontModule\DefaultModule;

/**
 * Represents the "Kronika" page and its subpages
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
class ChroniclePresenter extends BasePresenter
{

    /** @var \Models\Event */
    protected $events;

    /** @var  \Models\History */
    protected $histories;

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
	 * Checks for the chosen chronicle and displays it if it exists
     *
	 * @param int $id           chronicle Event ID
	 */
	public function actionDetail($id)
	{
        $template = $this->template;
        $template->title = "Kronika";
		$chronicle = $this->events->get($id);
		if(!$chronicle) {
			$this->flashMessage('Vybraná kronika neexistuje.');
			$this->redirect('Chronicle:');
		} elseif($chronicle->showchronicle === 0) {
			$this->flashMessage('Vybraná kornika momentálně není přístupná.');
			$this->redirect('Chronicle:');
		};
		$template->chronicle = $chronicle;
	}

    /**
     * Will eventually access the VIP chronicle
     *
     * @todo make VIP chornicle
     */
    public function actionVip()
    {
        $this->flashMessage('VIP kronika zatím není přístupná.');
        $this->redirect('Chronicle:');
    }

    /**
     * Sets variables for view of "Default" page
     */
    public function renderDefault()
    {
        $template = $this->template;
        $template->title = "Kronika";
        $vp = new \VisualPaginator($this, 'vp');
        $vp->short = FALSE; //output the whole list
        $vp->setTemplate('template-schoolyear.phtml');
        $paginator = $vp->getPaginator();
        $year = (idate("m")<8) ? idate("Y")-1 : idate("Y"); //school year start in August
        $paginator->setBase($this->context->parameters['baseChronicleYear']);
        $page = $vp->page ? $vp->page : $year;
        $paginator->setItemCount($year-$paginator->getBase()+1);
        $paginator->setItemsPerPage(1);
        $paginator->setPage($page);
        $template->chronicles = $this->events->getEventsForChronicle($page);

    }

    /**
	 * Sets variables for view of "Historie oddílu" page
	 */
	public function renderHistory()
	{
        $template = $this->template;
        $template->title = "Historie oddílu";
		$this->template->histories = $this->histories->getOrderedHistories();
	}

    /**
     * Creates the submenu
     *
     * @param String $name
     */
    protected function createComponentSubmenu($name) {
        $nav = new \Navigation\Navigation($this, $name);
        $nav->setMenuTemplate('submenu.latte');
        $nav->add("Kronika", "Chronicle:default");
        $nav->add("Historie oddílu", "Chronicle:history");
        $nav->add("VIP Kronika", "Chronicle:vip");
    }

}
