<?php
abstract class BoggleGuessedWordModel extends Model {

	private $wordId;

	public function getWordId() {
		return $this->wordId;
	}

	public function setWordId($wordId) {
		$this->wordId = $wordId;
	}

	private $word;

	public function getWord() {
		return $this->word;
	}

	public function setWord($word) {
		$this->word = $word;
	}

	private $gameId;

	public function getGameId() {
		return $this->gameId;
	}

	public function setGameId($gameId) {
		$this->gameId = $gameId;
	}

	private $playerId;

	public function getPlayerId() {
		return $this->playerId;
	}

	public function setPlayerId($playerId) {
		$this->playerId = $playerId;
	}

}
?>