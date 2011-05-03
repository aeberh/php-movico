<?php
abstract class BogglePlayerModel extends Model {

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

	private $gameId;

	public function getGameId() {
		return $this->gameId;
	}

	public function getBoggleGame() {
		return TeamServiceUtil::getTeam($this->teamId);
	}

	public function setGameId($gameId) {
		$this->gameId = $gameId;
	}

}
?>