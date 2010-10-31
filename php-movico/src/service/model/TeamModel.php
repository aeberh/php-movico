<?php
abstract class TeamModel extends Model {

	private $teamId;

	public function getTeamId() {
		return $this->teamId;
	}

	public function setTeamId($teamId) {
		$this->teamId = $teamId;
	}

	public function getPlayers() {
		return PlayerServiceUtil::getPlayers($this->teamId);
	}

}
?>