<?php
namespace FrontModule\DefaultModule;

/**
 * Base presenter for Frontend Default module.
 *
 * @author Patrick Kusebauch
 * @version 2.01, 09. 11. 2014
 */
abstract class BasePresenter extends \FrontModule\BasePresenter
{
	/**
	 * Creates component for Main menu
     *
	 * @param string $name
	 */
	protected function createComponentMenu($name) {
		$nav = new \Navigation\Navigation($this, $name);
		$nav->add("Úvod", "Homepage:");
		$nav->add("Aktuality/Akce", "News:");
		$nav->add("Organizace", "Organization:");
		$nav->add("Kronika", "Chronicle:");
		$nav->add("Hlásínek", "Hlasinek:");
		$nav->add("Kniha návštěv", "Guestbook:");
		$this->getUser()->isLoggedIn() ? $nav->add("Admin", ":Admin:Default:Homepage:") : NULL;
		$this->getUser()->isAllowed("Oddil:Homepage", "display") ? $nav->add("Oddíl", ":" . \OddilModule\OddilModule::MODULE_NAME . ":Front:Homepage:") : NULL;
	}
}
