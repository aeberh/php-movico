<?php
class PingpongGame extends PingpongGameModel {

	public function getHomeTeam() {
		return PingpongTeamServiceUtil::getPingpongTeam($this->getHomeTeamId());
	}
	
	public function getOutTeam() {
		return PingpongTeamServiceUtil::getPingpongTeam($this->getOutTeamId());
	}
	
	public function getHomeTeamStr() {
		return $this->getTeamStr($this->getHomeTeamId());
	}
	
	public function getOutTeamStr() {
		return $this->getTeamStr($this->getOutTeamId());
	}
	
	public function getHomeTeamPtsStr() {
		return $this->isPlayed() ? $this->getHomeTeamPts() : "";
	}
	
	public function getOutTeamPtsStr() {
		return $this->isPlayed() ? $this->getOutTeamPts() : "";
	}
	
	public function isTeamParticipating($teamId) {
		return $this->getHomeTeamId() == $teamId || $this->getOutTeamId() == $teamId;
	}
	
	public function isPlayed() {
		return $this->getDate()->isBefore(Date::createNow());
	}
	
	public function isHasReview() {
		$r = $this->getReview();
		return !empty($r);
	}
	
	public function getHasReviewStr() {
		return $this->isHasReview() ? "X" : "";
	}
	
	private function getTeamStr($teamId) {
		return PingpongTeamServiceUtil::getPingpongTeam($teamId)->getTeamStr();
	}
	
}
?>