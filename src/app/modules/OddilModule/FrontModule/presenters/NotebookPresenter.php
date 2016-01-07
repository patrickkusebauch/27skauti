<?php
namespace OddilModule\FrontModule;

/**
 * Represents the homepage and its sub-pages.
 *
 * @author Patrick Kusebauch
 * @version 3.00, 09. 11. 2014
 *
 * @Secured
 * @Resource("Oddil:Notebook")
 */
class NotebookPresenter extends BasePresenter
{

    /** @var  \Models\Notebook */
    protected $notebook;

    /**
     * Inject connection to notebook model
     *
     * @param \Models\Notebook $notebook
     * @throws \Nette\InvalidStateException
     */
    public function injectSongbook(\Models\Notebook $notebook) {
        if ($this->notebook) {
            throw new \Nette\InvalidStateException('Stezky has already been set');
        }
        $this->notebook = $notebook;
    }

    /**
     * Notebook overview
     *
     * @Privilege("display")
     */
    public function renderDefault() {
        $this->template->notebook = $this->notebook->findAll();
    }

    /**
     * Checks for the chosen chronicle and displays it if it exists
     *
     * @param int $id           notebook entry ID
     *
     * @Privilege("display")
     */
    public function actionDetail($id)
    {
        $template = $this->template;
        $template->title = "Zápisník";
        $notebook = $this->notebook->get($id);
        if(!$notebook) {
            $this->flashMessage('Vybraný zápis neexistuje.');
            $this->redirect('Notebook:');
        };
        $template->notebook = $notebook;
    }
}
