<?php
class PingpongTeam extends PingpongTeamModel {

	public function getTeamStr() {
		$clubName = PingpongClubServiceUtil::getPingpongClub($this->getClubId())->getShortName();
		return $clubName." ".$this->getFullTeamNo();
	}
	
	public function getGames() {
		$homeGames = PingpongGameServiceUtil::findByHomeTeam($this->getTeamId());
		$outGames = PingpongGameServiceUtil::findByOutTeam($this->getTeamId());
		return array_merge($homeGames, $outGames);
	}
	
	public function getClub() {
		return PingpongClubServiceUtil::getPingpongClub($this->getClubId());
	}
	
	public function getFullTeamNo() {
		return $this->isRecreation() ? "REC ".$this->getTeamNo() : $this->getTeamNo();
	}
	
}
?>