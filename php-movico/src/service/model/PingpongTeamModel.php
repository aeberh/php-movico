<?php
abstract class PingpongTeamModel extends Model {

	private $teamId;

	public function getTeamId() {
		return $this->teamId;
	}

	public function setTeamId($teamId) {
		$this->teamId = $teamId;
	}

	private $team;

	public function getTeam() {
		return $this->team;
	}

	public function setTeam($team) {
		$this->team = $team;
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