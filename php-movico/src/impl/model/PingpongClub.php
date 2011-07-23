<?php
class PingpongClub extends PingpongClubModel {

	public function getFullNumber() {
		return "LK".$this->getNumber();
	}
	
	public function isLanaken() {
		return $this->getShortName() === "Lanaken";
	}
	
	public function getTeams() {
		return PingpongTeamServiceUtil::findByClub($this->getClubId());
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