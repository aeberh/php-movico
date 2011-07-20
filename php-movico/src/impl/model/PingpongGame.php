<?php
class PingpongGame extends PingpongGameModel {

	public function getHomeTeamStr() {
		return $this->getTeamStr($this->getHomeTeamId());
	}
	
	public function getOutTeamStr() {
		return $this->getTeamStr($this->getOutTeamId());
	}
	
	private function getTeamStr($teamId) {
		return PingpongTeamServiceUtil::getPingpongTeam($teamId)->getTeamStr();
	}
	
}
?>