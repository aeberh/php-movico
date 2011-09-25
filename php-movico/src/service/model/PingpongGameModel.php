<?php
abstract class PingpongGameModel extends Model {

	protected $gameId;

	public function getGameId() {
		return $this->gameId;
	}

	public function setGameId($gameId) {
		$this->gameId = $gameId;
	}

	protected $date;

	public function getDate() {
		return $this->date;
	}

	public function setDate($date) {
		$this->date = $date;
	}

	protected $homeTeamId;

	public function getHomeTeamId() {
		return $this->homeTeamId;
	}

	public function setHomeTeamId($homeTeamId) {
		$this->homeTeamId = $homeTeamId;
	}

	protected $outTeamId;

	public function getOutTeamId() {
		return $this->outTeamId;
	}

	public function setOutTeamId($outTeamId) {
		$this->outTeamId = $outTeamId;
	}

	protected $homeTeamPts;

	public function getHomeTeamPts() {
		return $this->homeTeamPts;
	}

	public function setHomeTeamPts($homeTeamPts) {
		$this->homeTeamPts = $homeTeamPts;
	}

	protected $outTeamPts;

	public function getOutTeamPts() {
		return $this->outTeamPts;
	}

	public function setOutTeamPts($outTeamPts) {
		$this->outTeamPts = $outTeamPts;
	}

	protected $review;

	public function getReview() {
		return $this->review;
	}

	public function setReview($review) {
		$this->review = $review;
	}

}
?>