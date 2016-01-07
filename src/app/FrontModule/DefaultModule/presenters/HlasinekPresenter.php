<?php
namespace FrontModule\DefaultModule;

/**
 * Represents the hlasinek page and its subpages
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
class HlasinekPresenter extends BasePresenter
{
	/**
	 * Sets variable for view of "Default" page
	 */
	public function renderDefault()
	{
		//sets Pagination
		$vp  = new \VisualPaginator($this, 'vp');
		$vp->setTemplate('template-schoolyear.phtml');
		$vp->short = FALSE; //output the whole list
        $paginator = $vp->getPaginator();

        //get the data to paginate
        $params = $this->context->parameters;
		$folders = scandir($params['wwwDir'] . $params['hlasinekStorage']);
		$base = mb_substr($folders['2'], 0, 4); //starting folder, skipping "." & ".."

        //configuration
		$paginator->setBase($base);
		$paginator->setItemCount(count($folders) - 2); //substracts "." & ".."
        $paginator->setItemsPerPage(1);

        //default case
		$dir = end($folders);
		$page = $vp->page ? $vp->page : mb_substr($dir, 0, 4);
		$paginator->setPage($page);

        $template = $this->template;
        $template->title = "Hlásínek";
        $template->dir = $page . ((int) $page + 1);
	}
}