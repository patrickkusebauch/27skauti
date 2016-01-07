<?php
namespace AdminModule\DefaultModule;

/**
 * Overview of the admin
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 *
 * @Secured
 * @Resource("Admin:Default:Homepage")
 */
class HomepagePresenter extends BasePresenter
{
    /** @var  \Models\Privilege */
    protected $privileges;

    /**
     * Injects connection to privilege model
     *
     * @param \Models\Privilege $privilege
     * @throws \Nette\InvalidStateException
     */
    public function injectPrivilege(\Models\Privilege $privilege){
        if ($this->privileges) {
            throw new \Nette\InvalidStateException('Privilege has already been set');
        }
        $this->privileges = $privilege;
    }

    /**
     * Admin homepage
     *
	 * @Privilege("default")
	 */
	public function renderDefault()
	{
		$this->template->privilege = $this->privileges->getPersonalPrivileges($this->user->id);
	}

}
