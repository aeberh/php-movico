<?php
class PingpongPlayer extends PingpongPlayerModel {

	public function getFullName() {
		return $this->getFirstName()." ".$this->getLastName();
	}
	
	public function getAddress() {
		return $this->getStreet().", ".$this->getPlace();
	}
	
	public function getReferenceNo() {
		return $this->getActivePlayerList()->indexOf($this)+1;
	}
	
	public function getIndex() {
		$ref = $this->getReferenceNo();
		$players = $this->getActivePlayerList();
		$result = $ref;
		for($i=$ref; $i<$players->size(); $i++) {
			$player = $players->get($i);
			if($players->get($i)->getRanking() != $this->getRanking()) {
				return $player->getReferenceNo()-1;
				break;
			}
		}
		return $players->size();
	}
	
	public function getRecString() {
		return $this->isRecreation() ? "R" : "";
	}
	
	public function getActiveString() {
		return $this->isActive() ? "A" : "";
	}
	
	public function getMemberNoString() {
		return $this->getMemberNo() == 0 ? "" : $this->getMemberNo();
	}
	
	private function getActivePlayerList() {
		return ArrayList::fromArray("PingpongPlayer", PingpongPlayerServiceUtil::getActivePlayers());
	}
	
}
?>