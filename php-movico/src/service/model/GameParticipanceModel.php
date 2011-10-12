<?php
abstract class GameParticipanceModel extends Model {

	protected $partId;

	public function getPartId() {
		return $this->partId;
	}

	public function setPartId($partId) {
		$this->partId = $partId;
	}

	protected $gameId;

	public function getGameId() {
		return $this->gameId;
	}

	public function setGameId($gameId) {
		$this->gameId = $gameId;
	}

	protected $teamId;

	public function getTeamId() {
		return $this->teamId;
	}

	public function setTeamId($teamId) {
		$this->teamId = $teamId;
	}

	protected $playerId;

	public function getPlayerId() {
		return $this->playerId;
	}

	public function setPlayerId($playerId) {
		$this->playerId = $playerId;
	}

}
?>