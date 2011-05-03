<?php
abstract class BoggleGameModel extends Model {

	private $gameId;

	public function getGameId() {
		return $this->gameId;
	}

	public function setGameId($gameId) {
		$this->gameId = $gameId;
	}

	private $started;

	public function isStarted() {
		return $this->started;
	}

	public function setStarted($started) {
		$this->started = $started;
	}

	public function getPlayers($from=0, $limit=9999999999) {
		return BogglePlayerServiceUtil::findByGameId($this->gameId, $from=-1, $limit=-1);
	}

}
?>