<?php
namespace OddilModule\FrontModule;

/**
 * Represents the homepage and its sub-pages.
 *
 * @author Patrick Kusebauch
 * @version 3.00, 09. 11. 2014
 *
 * @Secured
 * @Resource("Oddil:Homepage")
 */
class HomepagePresenter extends BasePresenter
{
    /**
     * Homepage
     *
     * @Privilege("display")
     */
    public function renderDefault() {

    }
}
