<?php
class PingpongPlayer extends PingpongPlayerModel {

	public function getFullName() {
		return $this->firstName." ".$this->lastName;
	}
	
	public function getAddress() {
		$result = "";
		if(!empty($this->street)) {
			$result .= $this->street;
		}
		if(!empty($this->street) && !empty($this->place)) {
			$result .= ", ";
		}
		if(!empty($this->place)) {
			$result .= $this->place;
		}
		return $result;
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
	
	public function isHasAddress() {
		$address = $this->getAddress();
		return !empty($address);
	}
	
	public function getHasAddressStr() {
		return (empty($this->street) || empty($this->place)) ? "" : "X";
	}
	
	public function isHasEmail() {
		return !empty($this->emailAddress);
	}
	
	public function getHasEmailStr() {
		return $this->isHasEmail() ? "X" : "";
	}
	
	public function isHasPhone() {
		return !empty($this->phone);
	}
	
	public function getHasPhoneStr() {
		return $this->isHasPhone() ? "X" : "";
	}
	
	public function isHasMobile() {
		return !empty($this->mobile);
	}
	
	public function getHasMobileStr() {
		return $this->isHasMobile() ? "X" : "";
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