<?php
namespace FrontModule\DefaultModule;
/**
 * Represents the organizational structure
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
class OrganizationPresenter extends BasePresenter
{

    /** @var  \Models\Member */
    protected $members;

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
	 * Sets variables for view of "Struktura" page
	 */
	public function renderDefault()
	{
		$template = $this->template;
        $template->title = 'Organizace oddílu';
		$template->members = array();
		$template->members['Vedoucí'] = $this->members->getLeaders();
		$template->members['Roveři'] = $this->members->getRangers();
		$template->members['Mloci'] = $this->members->getMloci();
		$template->members['Tučňáci'] = $this->members->getTucnaci();
		$template->members['Nováčci'] = $this->members->getNewbies();
		$template->members['Oldskauti'] = $this->members->getOldscouts();
	}

    /**
	 * Sets variables for view of "Vedení" page
	 */
	public function renderLeader()
	{
        $template = $this->template;
        $template->title = 'Vedení';
		    $template->members = $this->members->getLeaders();
	}

    /**
     * Sets variables for view of "Mloci" page
     */
    public function renderMlok()
    {
        $template = $this->template;
        $template->title = 'Mloci';
        $template->members = $this->members->getMloci();
    }

    /**
     * Sets variables for view of "Nováčci" page
     */
    public function renderNewbie()
    {
        $template = $this->template;
        $template->title = 'Nováčci';
        $template->members = $this->members->getNewbies();
    }

    /**
     * Sets variables for view of "Oldskauti" page
     */
    public function renderOldscout()
    {
        $template = $this->template;
        $template->title = 'Oldskauti';
        $template->members = $this->members->getOldscouts();
    }

    /**
	 * Sets variables for view of "Roveři" page
	 */
	public function renderRanger()
	{
        $template = $this->template;
        $template->title = 'Roveři';
		$template->members = $this->members->getRangers();
	}

    /**
	 * Sets variables for view of "Tučňáci" page
	 */
	public function renderTucnak()
	{
        $template = $this->template;
        $template->title = 'Tučňáci';
		$template->members = $this->members->getTucnaci();
	}

    /**
     * Creates the submenu
     *
     * @param string $name
     */
    protected function createComponentSubmenu($name) {
        $nav = new \Navigation\Navigation($this, $name);
        $nav->setMenuTemplate('submenu.latte');
        $nav->add("Struktura", "Organization:default");
        $nav->add("Vedení", "Organization:leader");
        $nav->add("Roveři", "Organization:ranger");
        $nav->add("Mloci", "Organization:mlok");
        $nav->add("Tučňáci", "Organization:tucnak");
        $nav->add("Nováčci", "Organization:newbie");
        $nav->add("Oldskauti", "Organization:oldscout");
    }
}
