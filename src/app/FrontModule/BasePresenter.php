<?php
namespace FrontModule;
/**
 * Base presenter for all of Frontend
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
abstract class BasePresenter extends \BasePresenter
{
    /** @var \Kollarovic\Thumbnail\AbstractGenerator */
    protected $thumbnailGenerator;


    public function injectThumbnail(\Kollarovic\Thumbnail\AbstractGenerator $thumbnailGenerator)
    {
        $this->thumbnailGenerator = $thumbnailGenerator;
    }


    protected function createTemplate($class = NULL)
    {
        $template = parent::createTemplate($class);
        $template->registerHelper('thumbnail', $this->thumbnailGenerator->thumbnail);
        return $template;
    }
}
