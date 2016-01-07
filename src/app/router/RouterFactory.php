<?php
use Nette\Application\Routers\RouteList,
Nette\Application\Routers\Route;
/**
 * Router factory
 *
 * @author Patrick Kusebauch
 * @version 2.10, 18. 11. 2014
 */
class RouterFactory
{

	/**
     * Registers routes for modules
     *
	 * @return Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
        //\OddilModule\OddilModule::createRoutes($router, '//oddil.27skauti.cz/');
        //\DefaultModule\DefaultModule::createRoutes($router, '//[!www.]27skauti.cz/');
        \OddilModule\OddilModule::createRoutes($router, 'oddil/');
        \DefaultModule\DefaultModule::createRoutes($router, '/');
		return $router;
	}

}
