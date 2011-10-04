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
	
	public function getReviewTeamStr() {
		$teams = array();
		$homeTeam = $this->getHomeTeam();
		if($homeTeam->isLanaken()) {
			$teams[] = $homeTeam;
		}
		$outTeam = $this->getOutTeam();
		if($outTeam->isLanaken()) {
			$teams[] = $outTeam;
		}
		$nbTeams = count($teams);
		if($nbTeams == 1) {
			return $teams[0]->getTeamStr();
		} elseif($nbTeams == 2) {
			$prefix = $teams[0]->isRecreation() ? "" : "Lanaken ";
			return $prefix.$teams[0]->getFullTeamNo()." vs ".$teams[1]->getFullTeamNo();
		} else {
			return "";
		}
	}
	
	private function getTeamStr($teamId) {
		return PingpongTeamServiceUtil::getPingpongTeam($teamId)->getTeamStr();
	}
	
}
?>