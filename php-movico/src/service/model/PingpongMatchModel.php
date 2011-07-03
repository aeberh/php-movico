<?php
abstract class PingpongMatchModel extends Model {

	private $matchId;

	public function getMatchId() {
		return $this->matchId;
	}

	public function setMatchId($matchId) {
		$this->matchId = $matchId;
	}

	private $date;

	public function getDate() {
		return $this->date;
	}

	public function setDate($date) {
		$this->date = $date;
	}

	private $homeTeamId;

	public function getHomeTeamId() {
		return $this->homeTeamId;
	}

	public function setHomeTeamId($homeTeamId) {
		$this->homeTeamId = $homeTeamId;
	}

	private $outTeamId;

	public function getOutTeamId() {
		return $this->outTeamId;
	}

	public function setOutTeamId($outTeamId) {
		$this->outTeamId = $outTeamId;
	}

	private $homeTeamPoints;

	public function getHomeTeamPoints() {
		return $this->homeTeamPoints;
	}

	public function setHomeTeamPoints($homeTeamPoints) {
		$this->homeTeamPoints = $homeTeamPoints;
	}

	private $outTeamPoints;

	public function getOutTeamPoints() {
		return $this->outTeamPoints;
	}

	public function setOutTeamPoints($outTeamPoints) {
		$this->outTeamPoints = $outTeamPoints;
	}

	private $review;

	public function getReview() {
		return $this->review;
	}

	public function setReview($review) {
		$this->review = $review;
	}

}
?>