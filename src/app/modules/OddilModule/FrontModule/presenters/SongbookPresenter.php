<?php
namespace OddilModule\FrontModule;

/**
 * Represents the homepage and its sub-pages.
 *
 * @author Patrick Kusebauch
 * @version 3.00, 09. 11. 2014
 *
 * @Secured
 * @Resource("Oddil:Songbook")
 */
class SongbookPresenter extends BasePresenter
{

    /** @var  \Models\Songbook */
    protected $songbook;

    /**
     * Inject connection to songbook model
     *
     * @param \Models\Songbook $songbook
     * @throws \Nette\InvalidStateException
     */
    public function injectSongbook(\Models\Songbook $songbook) {
        if ($this->songbook) {
            throw new \Nette\InvalidStateException('Stezky has already been set');
        }
        $this->songbook = $songbook;
    }

    /**
     * Songbook overview
     *
     * @Privilege("display")
     */
    public function renderDefault() {
        $this->template->songbook = $this->songbook->findAll();
    }

    /**
     * Checks for the chosen chronicle and displays it if it exists
     *
     * @param int $id           songbook entry ID
     *
     * @Privilege("display")
     */
    public function actionDetail($id)
    {
        $template = $this->template;
        $template->title = "Zpěvník";
        $songbook = $this->songbook->get($id);
        if(!$songbook) {
            $this->flashMessage('Vybraný zápis neexistuje.');
            $this->redirect('Songbook:');
        };
        $template->songbook = $songbook;
    }
}