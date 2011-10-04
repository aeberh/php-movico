<?php
class ManagePlayersBean extends RequestBean {
	
	private $selected;
	private $selectedPassPlayers;
	
	private $redirectUrl;
	
	public function __construct() {
		if(Context::hasParam(0)) {
			$this->selected = PingpongPlayerServiceUtil::getPingpongPlayer(Context::getParam(0));
		} else {
			$this->selected = new PingpongPlayer();
		}
		$this->redirectUrl = Context::getParam(1, null);
	}
	
	public function getPlayers() {
		return PingpongPlayerServiceUtil::getPingpongPlayers();
	}
	
	public function getPlayersWithEmail() {
		return PingpongPlayerServiceUtil::getPlayersWithEmail();
	}
	
	public function create() {
		try {
			PingpongPlayerServiceUtil::create($this->selected->getFirstName(), $this->selected->getLastName(), $this->selected->getMemberNo(),
				$this->selected->getRanking(), $this->selected->isRecreation(), $this->selected->getStreet(), $this->selected->getPlace(), 
				$this->selected->getEmailAddress(), $this->selected->getPhone(), $this->selected->getMobile());
			MessageUtil::success("Lid werd succesvol toegevoegd!");
			return "admin/players/overview";
		} catch(RequiredInformationException $e) {
			MessageUtil::error("Een of meer verplichte velden werden niet ingevuld!");
			return null;
		}
	}
	
	public function save() {
		try {
			PingpongPlayerServiceUtil::update($this->selected->getPlayerId(), $this->selected->getFirstName(), $this->selected->getLastName(), 
				$this->selected->getMemberNo(), $this->selected->getRanking(), $this->selected->isActive(), $this->selected->isRecreation(), 
				$this->selected->getStreet(), $this->selected->getPlace(), $this->selected->getEmailAddress(), $this->selected->getPhone(),
				$this->selected->getMobile());
			MessageUtil::success("Lid werd succesvol aangepast!");
			return empty($this->redirectUrl) ? "admin/players/overview" : $this->redirectUrl;
		} catch(RequiredInformationException $e) {
			MessageUtil::error("Een of meer verplichte velden werden niet ingevuld!");
			return null;
		}
	}
	
	public function delete($playerId) {
		PingpongPlayerServiceUtil::deletePingpongPlayer($playerId);
		MessageUtil::success("Lid werd succesvol verwijderd!");
		return null;
	}
	
	public function generatePasswords() {
		$failed = array();
		foreach($this->selectedPassPlayers as $playerId) {
			try {
				PingpongPlayerServiceUtil::generateNewPassword($playerId);
			} catch(Exception $e) {
				$player = PingpongPlayerServiceUtil::getPingpongPlayer($playerId);
				$failed[] = $player->getFullName()." (".$player->getEmailAddress().")";
			}
		}
		if(empty($failed)) {
			MessageUtil::success("Wachtwoorden werden succesvol gewijzigd en opgestuurd!");
		} else {
			MessageUtil::error("Door een fout hebben volgende spelers geen email ontvangen: ".implode(", ", $failed));
		}
		return null;
	}
	
	public function getSelected() {
		return $this->selected;
	}
	
	public function getSelectedPassPlayers() {
		return $this->selectedPassPlayers;
	}
	
	public function setSelectedPassPlayers($selectedPassPlayers) {
		$this->selectedPassPlayers = $selectedPassPlayers;
	}
	
	public function getRedirectUrl() {
		return $this->redirectUrl;
	}
	
	public function setRedirectUrl($redirectUrl) {
		$this->redirectUrl = $redirectUrl;
	}
	
}
?>