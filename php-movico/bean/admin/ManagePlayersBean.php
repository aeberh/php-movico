<?php
class ManagePlayersBean extends RequestBean {
	
	private $selected;
	
	public function __construct() {
		$this->selected = new PingpongPlayer();
	}
	
	public function getPlayers() {
		return PingpongPlayerServiceUtil::getPingpongPlayers();
	}
	
	public function create() {
		try {
			PingpongPlayerServiceUtil::create($this->selected->getFirstName(), $this->selected->getLastName(), $this->selected->getMemberNo(),
				$this->selected->getRanking(), $this->selected->isRecreation(), $this->selected->getStartYear(),
				$this->selected->getStreet(), $this->selected->getPlace(), $this->selected->getEmailAddress(), $this->selected->getPhone());
			MessageUtil::info("Lid werd succesvol toegevoegd!");
			return "admin/players/overview";
		} catch(RequiredInformationException $e) {
			MessageUtil::error("Een of meer verplichte velden werden niet ingevuld!");
			return null;
		}
	}
	
	public function edit($playerId) {
		$this->selected = PingpongPlayerServiceUtil::getPingpongPlayer($playerId);
		return "admin/players/edit";
	}
	
	public function save() {
		try {
			PingpongPlayerServiceUtil::update($this->selected->getPlayerId(), $this->selected->getFirstName(), $this->selected->getLastName(), $this->selected->getMemberNo(),
				$this->selected->getRanking(), $this->selected->isActive(), $this->selected->isRecreation(), $this->selected->getStartYear(),
				$this->selected->getStreet(), $this->selected->getPlace(), $this->selected->getEmailAddress(), $this->selected->getPhone());
			MessageUtil::info("Lid werd succesvol aangepast!");
			return "admin/players/overview";
		} catch(RequiredInformationException $e) {
			MessageUtil::error("Een of meer verplichte velden werden niet ingevuld!");
			return null;
		}
	}
	
	public function delete($playerId) {
		PingpongPlayerServiceUtil::deletePingpongPlayer($playerId);
		MessageUtil::info("Lid werd succesvol verwijderd!");
		return null;
	}
	
	public function getSelected() {
		return $this->selected;
	}
	
}
?>