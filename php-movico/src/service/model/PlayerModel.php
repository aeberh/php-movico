<?php
abstract class PlayerModel extends Model {

	private $playerId;

	public function getPlayerId() {
		return $this->playerId;
	}

	public function setPlayerId($playerId) {
		$this->playerId = $playerId;
	}

	private $name;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	private $teamId;

	public function getTeamId() {
		return $this->teamId;
	}

	public function getTeam() {
		return TeamServiceUtil::getTeam($this->teamId);
	}

	public function setTeamId($teamId) {
		$this->teamId = $teamId;
	}

}
?>