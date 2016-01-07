<?php
namespace AdminModule\DefaultModule;
/**
 * Base presenter for Admin
 *
 * Provides shared functionally specific only for admin Default module
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
abstract class BasePresenter extends \AdminModule\BasePresenter
{
	/**
	 * Navigation for admin
	 */
	protected function createComponentMenu($name) {
		$nav = new \Navigation\Navigation($this, $name);
		$nav->add("Domů", "Homepage:");
		$nav->add("Profil", "User:");
		if($this->user->isAllowed('Admin:Default:News' , 'default'))$nav->add("Aktuality", "News:");
		if($this->user->isAllowed('Admin:Default:Event' , 'default'))$nav->add("Akce", "Event:");
		if($this->user->isAllowed('Admin:Default:Chronicle' , 'default'))$nav->add("Kronika", "Chronicle:");
		if($this->user->isAllowed('Admin:Default:Vipchronicle' , 'default'))$nav->add("VIP Kronika", "Vipchronicle:");
		if($this->user->isAllowed('Admin:Default:Hlasinek', 'default'))$nav->add("Hlásínek", "Hlasinek:");
		if($this->user->isAllowed('Admin:Default:Organization', 'default'))$nav->add("Organizace", "Organization:");
		if($this->user->isAllowed('Admin:Default:Registration', 'default'))$nav->add("Registrace", "Registration:");
		if($this->user->isAllowed('Admin:Default:History' , 'default'))$nav->add("Historie oddílu", "History:");
		if($this->user->isAllowed('Admin:Default:Guestbook' , 'default'))$nav->add("Kniha Návštěv", "Guestbook:");
		if($this->user->isAllowed('Admin:Default:Privilege' , 'default'))$nav->add("Práva", "Privilege:");
		if($this->user->isAllowed('Admin:Default:Privilege' , 'default'))$nav->add("SkautIS", "Skautis:");
		$nav->add("27skauti", ":Front:Default:Homepage:");
	}
}
