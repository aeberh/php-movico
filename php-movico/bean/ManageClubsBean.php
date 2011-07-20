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
		PingpongClubServiceUtil::create($this->selected->getNumber(), $this->selected->getName(), $this->selected->getLocation());
		MessageUtil::info("Club werd succesvol toegevoegd!");
		return "admin/clubs/overview";
	}
	
	public function edit() {
		$this->selected = $this->getSelectedClub();
		return "admin/clubs/edit";
	}
	
	public function save() {
		PingpongClubServiceUtil::update($this->selected->getClubId(), $this->selected->getLocation());
		MessageUtil::info("Club werd succesvol aangepast!");
		return "admin/clubs/overview";
	}
	
	public function delete() {
		PingpongClubServiceUtil::delete($this->getSelectedClub());
		MessageUtil::info("Club werd succesvol verwijderd!");
		return "admin/clubs/overview";
	}
	
	private function getSelectedClub() {
		$clubs = $this->getClubs();
		return $clubs[$this->getSelectedRowIndex()];
	}
	
	public function getSelected() {
		return $this->selected;
	}
	
}
?>