<?php
class ManageClubsBean extends RequestBean {
	
	private $selected;
	
	public function __construct() {
		$this->selected = Context::hasParam(0) ? PingpongClubServiceUtil::getPingpongClub(Context::getParam(0)) : new PingpongClub();
	}
	
	public function getClubs() {
		return PingpongClubServiceUtil::getPingpongClubs();
	}
	
	public function create() {
		try {
			PingpongClubServiceUtil::create($this->selected->getNumber(), $this->selected->getShortName(),
				$this->selected->getName(), $this->selected->getBuilding(), $this->selected->getStreet(), 
				$this->selected->getPlace(), $this->selected->getDistance(), $this->selected->getPhone());
			MessageUtil::success("Club werd succesvol toegevoegd!");
			return "admin/clubs/overview";
		} catch(RequiredInformationException $e) {
			MessageUtil::error("Een of meer verplichte velden werden niet ingevuld!");
			return null;
		}
	}

	public function save() {
		try {
			PingpongClubServiceUtil::update($this->selected->getClubId(), $this->selected->getNumber(), 
				$this->selected->getShortName(), $this->selected->getName(), $this->selected->getBuilding(), $this->selected->getStreet(), 
				$this->selected->getPlace(), $this->selected->getDistance(), $this->selected->getPhone());
			MessageUtil::success("Club werd succesvol aangepast!");
			return "admin/clubs/overview";
		} catch(RequiredInformationException $e) {
			MessageUtil::error("Een of meer verplichte velden werden niet ingevuld!");
			return null;
		}
	}
	
	public function delete($clubId) {
		try {
			PingpongClubServiceUtil::delete(PingpongClubServiceUtil::getPingpongClub($clubId));
			MessageUtil::success("Club werd succesvol verwijderd!");
		} catch(ExistingGamesForClubException $e) {
			MessageUtil::error("De club kan niet verwijderd worden omdat deze reeds wedstrijden bevat");
		}
		return null;
	}
	
	public function getSelected() {
		return $this->selected;
	}
	
}
?>