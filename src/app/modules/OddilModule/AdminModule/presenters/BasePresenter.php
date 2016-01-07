<?php
namespace OddilModule\AdminModule;
/**
 * Base presenter for Admin
 *
 * Provides shared functionally specific only for admin Default module
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
abstract class BasePresenter extends \BasePresenter
{
	/**
	 * Navigation for admin
	 */
	protected function createComponentMenu($name) {
		$nav = new \Navigation\Navigation($this, $name);
		$nav->add("Domů", "Homepage:");
		$nav->add("Profil", "User:");
		if($this->user->isAllowed('Admin:Default:Privilege' , 'default'))$nav->add("Stezky", "Stezky:");
		if($this->user->isAllowed('Admin:Default:Privilege' , 'default'))$nav->add("Zápisník", "Notebook:");
		if($this->user->isAllowed('Admin:Default:Privilege' , 'default'))$nav->add("Zpěvník", "Songbook:");
		$nav->add("27skauti", ":Oddil:Front:Homepage:");
	}
}
