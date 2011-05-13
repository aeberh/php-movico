<?php
abstract class BubbleHighScoreModel extends Model {

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

	private $playDate;

	public function getPlayDate() {
		return $this->playDate;
	}

	public function setPlayDate($playDate) {
		$this->playDate = $playDate;
	}

	private $seconds;

	public function getSeconds() {
		return $this->seconds;
	}

	public function setSeconds($seconds) {
		$this->seconds = $seconds;
	}

}
?>