<?php
class BoggleHighScoreServiceBase {

	public function createBoggleHighScore($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getBoggleHighScore($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateBoggleHighScore(BoggleHighScore $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteBoggleHighScore($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getBoggleHighScores($from, $limit) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countBoggleHighScores() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("BoggleHighScorePersistence");
	}

}
?>