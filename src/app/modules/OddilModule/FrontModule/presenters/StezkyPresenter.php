<?php
namespace OddilModule\FrontModule;

/**
 * Represents the homepage and its sub-pages.
 *
 * @author Patrick Kusebauch
 * @version 3.00, 09. 11. 2014
 *
 * @Secured
 * @Resource("Oddil:Stezky")
 */
class StezkyPresenter extends BasePresenter
{

    /** @var  \Models\Stezky */
    protected $stezky;

    /**
     * Inject connection to Stezky model
     *
     * @param \Models\Stezky $stezky
     * @throws \Nette\InvalidStateException
     */
    public function injectGuestbook(\Models\Stezky $stezky) {
        if ($this->stezky) {
            throw new \Nette\InvalidStateException('Stezky has already been set');
        }
        $this->stezky = $stezky;
    }

    /**
     * Stezky overview
     *
     * @Privilege("display")
     */
    public function renderDefault() {
		$template = $this->template;
		$template->overview = $this->stezky->getTotalSigned();
		$template->myOverview = $this->stezky->getMemberOverview('Krtek');
		$allMembers = $template->overview;
		$template->allOverviews = [];
		foreach($allMembers as $member) {
			$template->allOverviews[$member->nickname] = $this->stezky->getMemberOverview($member->nickname);
		}
		$template->detail = $this->stezky->getPersonDetail('Krtek');
	}
}
