<?php
class PingpongPlayer extends PingpongPlayerModel {

	public function getFullName() {
		return $this->firstName." ".$this->lastName;
	}
	
	public function getAddress() {
		return $this->street.", ".$this->place;
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
		return $this->recreation ? "R" : "";
	}
	
	public function getActiveString() {
		return $this->active ? "A" : "";
	}
	
	public function getHasAddressStr() {
		return (empty($this->street) || empty($this->place)) ? "" : "X";
	}
	
	public function getHasEmailStr() {
		return empty($this->emailAddress) ? "" : "X";
	}
	
	public function getHasPhoneStr() {
		return empty($this->phone) ? "" : "X";
	}
	
	public function getHasMobileStr() {
		return empty($this->mobile) ? "" : "X";
	}
	
	public function getMemberNoString() {
		return $this->memberNo == 0 ? "" : $this->memberNo;
	}
	
	public function __toString() {
		return $this->getFullName();
	}
	
	private function getActivePlayerList() {
		return ArrayList::fromArray("PingpongPlayer", PingpongPlayerServiceUtil::getActivePlayers());
	}
	
}
?>