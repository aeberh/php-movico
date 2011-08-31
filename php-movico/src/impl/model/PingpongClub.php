<?php
class PingpongClub extends PingpongClubModel {

	const JEVOTA_CLUB_NO = "031";
	
	public function getFullNumber() {
		return "LK".$this->getNumber();
	}
	
	public function isLanaken() {
		return $this->getNumber() === self::JEVOTA_CLUB_NO;
	}
	
	public function getTeams() {
		return PingpongTeamServiceUtil::findByClub($this->getClubId());
	}
	
	public function isHasBuilding() {
		return !String::create($this->getBuilding())->trim()->isEmpty();
	}
	
	public function isHasPhone() {
		return !String::create($this->getPhone())->trim()->isEmpty();
	}
	
	public function getAddress() {
		$street = $this->getStreet();
		$place = $this->getPlace();
		$comma = empty($street) || empty($place) ? "" : ", ";
		return $street.$comma.$place;
	}
	
	public function getGames() {
		$result = array();
		foreach($this->getTeams() as $team) {
			$result = array_merge($result, $team->getGames());
		}
		return $result;
	}
	
	public function isHasGames() {
		$games = $this->getGames();
		return !empty($games);
	}
	
}
?>