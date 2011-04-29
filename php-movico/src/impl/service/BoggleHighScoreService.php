<?php
class BoggleHighScoreService extends BoggleHighScoreServiceBase {

	public function create($name, $points) {
		$hscore = $this->createBoggleHighScore();
		$hscore->setName($name);
		$hscore->setPlayDate(Date::createNow());
		$hscore->setPoints($points);
		return $this->updateBoggleHighScore($hscore);
	}
	
}
?>