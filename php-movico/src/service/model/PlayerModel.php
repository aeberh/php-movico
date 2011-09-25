<?php
abstract class PlayerModel extends Model {

	protected $playerId;

	public function getPlayerId() {
		return $this->playerId;
	}

	public function setPlayerId($playerId) {
		$this->playerId = $playerId;
	}

	protected $name;

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