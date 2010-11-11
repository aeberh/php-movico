<?php
abstract class TeamModel extends Model {

	private $teamId;

	public function getTeamId() {
		return $this->teamId;
	}

	public function setTeamId($teamId) {
		$this->teamId = $teamId;
	}

	private $name;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getPlayers() {
		return PlayerServiceUtil::findByTeamId($this->teamId);
	}

}
?>