<?php
class ManageClubsBean extends RequestBean {
	
	private $selected;
	
	public function __construct() {
		$this->selected = new PingpongClub();
	}
	
	public function getClubs() {
		return PingpongClubServiceUtil::getPingpongClubs();
	}
	
	public function create() {
		PingpongClubServiceUtil::create($this->selected->getNumber(), $this->selected->getShortName(), $this->selected->getName(), $this->selected->getAddress(),
			$this->selected->getDistance(), $this->selected->getPhone());
		MessageUtil::info("Club werd succesvol toegevoegd!");
		return "admin/clubs/overview";
	}
	
	public function edit($clubId) {
		$this->selected = PingpongClubServiceUtil::getPingpongClub($clubId);
		return "admin/clubs/edit";
	}
	
	public function save() {
		PingpongClubServiceUtil::update($this->selected->getClubId(), $this->selected->getNumber(), $this->selected->getShortName(), $this->selected->getName(), $this->selected->getAddress(),
			$this->selected->getDistance(), $this->selected->getPhone());
		MessageUtil::info("Club werd succesvol aangepast!");
		return "admin/clubs/overview";
	}
	
	public function delete($clubId) {
		try {
			PingpongClubServiceUtil::delete(PingpongClubServiceUtil::getPingpongClub($clubId));
			MessageUtil::info("Club werd succesvol verwijderd!");
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