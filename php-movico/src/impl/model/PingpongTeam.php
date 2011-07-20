<?php
class PingpongTeam extends PingpongTeamModel {

	public function getTeamStr() {
		$clubName = PingpongClubServiceUtil::getPingpongClub($this->getClubId())->getName();
		$rec = $this->isRecreation() ? " REC" : "";
		return $clubName.$rec." ".$this->getTeamNo();
	}
	
}
?>