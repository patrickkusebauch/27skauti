<?php
namespace OddilModule\FrontModule;

/**
 * Base presenter for Frontend Default module.
 *
 * @author Patrick Kusebauch
 * @version 2.01, 09. 11. 2014
 */
abstract class BasePresenter extends \BasePresenter
{
	/**
	 * Creates component for Main menu
     *
	 * @param string $name
	 */
	protected function createComponentMenu($name) {
		$nav = new \Navigation\Navigation($this, $name);
		$nav->add("Úvod", "Homepage:");
		$nav->add("Bodování", "Attendance:");
		$nav->add("Stezky", "Stezky:");
		$nav->add("Zpěvník", "Songbook:");
		$nav->add("Zápisník", "Notebook:");
		$nav->add("27skauti.cz", ":Front:Default:Homepage:");
		$this->getUser()->isLoggedIn() ? $nav->add("Admin", ":Oddil:Admin:Homepage:") : NULL;
	}
}
