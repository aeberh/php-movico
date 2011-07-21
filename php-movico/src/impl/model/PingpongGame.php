<?php
class PingpongGame extends PingpongGameModel {

	public function getHomeTeamStr() {
		return $this->getTeamStr($this->getHomeTeamId());
	}
	
	public function getOutTeamStr() {
		return $this->getTeamStr($this->getOutTeamId());
	}
	
	public function isHasReview() {
		$r = $this->getReview();
		return !empty($r);
	}
	
	private function getTeamStr($teamId) {
		return PingpongTeamServiceUtil::getPingpongTeam($teamId)->getTeamStr();
	}
	
}
?>