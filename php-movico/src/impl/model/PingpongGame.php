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
	
	public function getHomeParticipants() {
		return $this->getParticipants($this->homeTeamId, "player");
	}
	
	public function getOutParticipants() {
		return $this->getParticipants($this->outTeamId, "player");
	}
	
	public function getHomeParticipantIds() {
		return $this->getParticipants($this->homeTeamId, "playerId", "playerId");
	}
	
	public function getOutParticipantIds() {
		return $this->getParticipants($this->outTeamId, "playerId", "playerId");
	}
	
	private function getParticipants($teamId, $keyGetter, $valueGetter=null) {
		$parts = GameParticipanceServiceUtil::findByGameAndTeam($this->gameId, $teamId);
		if(is_null($valueGetter)) {
			return ArrayUtil::toArray($parts, $keyGetter);
		}
		return ArrayUtil::toIndexedArray($parts, $keyGetter, $valueGetter);
	}
	
	public function isHomeTeamLanaken() {
		return $this->getHomeTeam()->isLanaken();
	}
	
	public function isOutTeamLanaken() {
		return $this->getOutTeam()->isLanaken();
	}
	
	public function getSeasonYear() {
		return $this->getSeason($this->getDate());
	}
	
	public function isInCurrentSeason() {
		return $this->getSeasonYear() == $this->getSeason(Date::createNow());
	}
	
	private function getSeason(Date $date) {
		return $date->getWeek() > 30 ? $date->getYear() : $date->getYear()+1;
	}
	
	private function getTeamStr($teamId) {
		return PingpongTeamServiceUtil::getPingpongTeam($teamId)->getTeamStr();
	}
	
}
?>