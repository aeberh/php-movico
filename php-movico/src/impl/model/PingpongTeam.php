<?php
class PingpongTeam extends PingpongTeamModel {

	public function getTeamStr() {
		$clubName = PingpongClubServiceUtil::getPingpongClub($this->getClubId())->getName();
		$rec = $this->isRecreation() ? " REC" : "";
		return $clubName.$rec." ".$this->getTeamNo();
	}
	
	public function getGames() {
		$homeGames = PingpongGameServiceUtil::findByHomeTeam($this->getTeamId());
		$outGames = PingpongGameServiceUtil::findByOutTeam($this->getTeamId());
		return array_merge($homeGames, $outGames);
	}
	
}
?>