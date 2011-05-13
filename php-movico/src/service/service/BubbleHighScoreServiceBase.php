<?php
class BubbleHighScoreServiceBase {

	public function createBubbleHighScore($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getBubbleHighScore($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateBubbleHighScore(BubbleHighScore $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteBubbleHighScore($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getBubbleHighScores($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countBubbleHighScores() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("BubbleHighScorePersistence");
	}

}
?>