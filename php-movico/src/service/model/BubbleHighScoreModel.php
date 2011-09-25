<?php
abstract class BubbleHighScoreModel extends Model {

	protected $hscoreId;

	public function getHscoreId() {
		return $this->hscoreId;
	}

	public function setHscoreId($hscoreId) {
		$this->hscoreId = $hscoreId;
	}

	protected $name;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	protected $playDate;

	public function getPlayDate() {
		return $this->playDate;
	}

	public function setPlayDate($playDate) {
		$this->playDate = $playDate;
	}

	protected $seconds;

	public function getSeconds() {
		return $this->seconds;
	}

	public function setSeconds($seconds) {
		$this->seconds = $seconds;
	}

}
?>