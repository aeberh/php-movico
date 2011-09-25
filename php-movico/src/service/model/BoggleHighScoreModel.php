<?php
abstract class BoggleHighScoreModel extends Model {

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

	protected $lang;

	public function getLang() {
		return $this->lang;
	}

	public function setLang($lang) {
		$this->lang = $lang;
	}

	protected $grid;

	public function getGrid() {
		return $this->grid;
	}

	public function setGrid($grid) {
		$this->grid = $grid;
	}

	protected $points;

	public function getPoints() {
		return $this->points;
	}

	public function setPoints($points) {
		$this->points = $points;
	}

	protected $playDate;

	public function getPlayDate() {
		return $this->playDate;
	}

	public function setPlayDate($playDate) {
		$this->playDate = $playDate;
	}

}
?>