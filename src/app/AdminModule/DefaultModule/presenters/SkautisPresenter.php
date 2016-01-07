<?php
namespace AdminModule\DefaultModule;

/**
 * IS skaut
 *
 * @author Patrick Kusebauch
 * @version 1.0.0, 22. 12. 2014
 */
class SkautisPresenter extends BasePresenter
{
    /** @var  \SkautIS\SkautIS */
    protected $skautIS;

    /** @var  \Models\Registration */
    protected $registrations;

    /**
     * Injects connection to IS skaut
     *
     * @param \SkautIS\SkautIS $skautIS
     * @throws \Nette\InvalidStateException
     */
    public function injectEvent(\SkautIS\SkautIS $skautIS){
        if ($this->skautIS) {
            throw new \Nette\InvalidStateException('SkautIS has already been set');
        }
        $this->skautIS = $skautIS;
    }

    /**
     * Injects connection to member model
     *
     * @param \Models\Registration $registrations
     * @throws \Nette\InvalidStateException
     */
    public function injectMember(\Models\Registration $registrations){
        if ($this->registrations) {
            throw new \Nette\InvalidStateException('Member has already been set');
        }
        $this->registrations = $registrations;
    }

    public function actionDefault(){
        $postData = $this->request->getPost();
	if ($this->skautIS->isLoggedIn()){
            $this->skautIS->updateLogoutTime();
	} elseif (array_key_exists('skautIS_Token', $postData)
		&& array_key_exists('skautIS_IDRole', $postData)
	       	&& array_key_exists('skautIS_IDUnit', $postData)){
		$this->skautIS->setLoginData($postData['skautIS_Token'], $postData['skautIS_IDRole'], $postData['skautIS_IDUnit']);
        } else {
            $this->redirect('login');
        }
    }

    public function renderPeople(){
        $ISmembers = $this->skautIS->org->PersonAllExport(array("ID_Unit" =>25634));
        $this->template->person = [];
        $this->template->validMembers = [];
        $this->template->validISmembers = [];
        $this->template->invalidISmembers = [];
        $reg_numbers = [];
        foreach($ISmembers as $ISmember) {
            $reg = $ISmember->RegistrationNumber;
            $member = $this->registrations->getBy(['registration_number' => $reg]);
            if($member) {
                $this->template->person[] = $ISmember;
                $this->template->validMembers[] = $member;
                $this->template->validISmembers[] = $ISmember;
                $reg_numbers[] = $reg;
            } else {
                $this->template->invalidISmembers[] = $ISmember;
            }
        };
        if(count($this->template->validISmembers) === count($this->template->validMembers)) {
            $this->template->validSize = count($this->template->validISmembers);
        } else {
            $this->error('Došlo k chybě při komunikaci s IS skautem.', \Nette\Http\IResponse::S500_INTERNAL_SERVER_ERROR);
        }
        $this->template->invalidMembers = $this->registrations->findAll()
            ->where('registration_number NOT ? OR registration_number IS NULL', $reg_numbers);

    }

    public function renderUnit(){
	    $this->template->units = $this->skautIS->org->UnitAllUnit(array("ID_Unit" =>25634));
	    $this->template->unit = $this->skautIS->org->UnitDetail(array("ID_Unit" =>25634));
    }
    /**
	 * Sets variable for view of "Default" page
	 */
	public function renderLogin()
	{
        $this->template->loginUrl = $this->skautIS->getLoginUrl();
	}
}
