<?php
class BoggleHighScoreService extends BoggleHighScoreServiceBase {

	public function create($name, $lang, BoggleGrid $grid, $points) {
		$hscore = $this->createBoggleHighScore();
		$hscore->setName($name);
		$hscore->setLang($lang);
		$hscore->setGrid($grid->getChars());
		$hscore->setPlayDate(Date::createNow());
		$hscore->setPoints($points);
		return $this->updateBoggleHighScore($hscore);
	}
	
}
?>