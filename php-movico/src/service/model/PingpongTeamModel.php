<?php
abstract class PingpongTeamModel extends Model {

	private $teamId;

	public function getTeamId() {
		return $this->teamId;
	}

	public function setTeamId($teamId) {
		$this->teamId = $teamId;
	}

	private $clubId;

	public function getClubId() {
		return $this->clubId;
	}

	public function setClubId($clubId) {
		$this->clubId = $clubId;
	}

	private $teamNo;

	public function getTeamNo() {
		return $this->teamNo;
	}

	public function setTeamNo($teamNo) {
		$this->teamNo = $teamNo;
	}

	private $recreation;

	public function isRecreation() {
		return $this->recreation;
	}

	public function setRecreation($recreation) {
		$this->recreation = $recreation;
	}

}
?>