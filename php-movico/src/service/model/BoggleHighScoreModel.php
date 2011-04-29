<?php
abstract class BoggleHighScoreModel extends Model {

	private $hscoreId;

	public function getHscoreId() {
		return $this->hscoreId;
	}

	public function setHscoreId($hscoreId) {
		$this->hscoreId = $hscoreId;
	}

	private $name;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	private $points;

	public function getPoints() {
		return $this->points;
	}

	public function setPoints($points) {
		$this->points = $points;
	}

	private $playDate;

	public function getPlayDate() {
		return $this->playDate;
	}

	public function setPlayDate($playDate) {
		$this->playDate = $playDate;
	}

}
?>