<?php
class BoggleGuessedWordServiceBase {

	public function createBoggleGuessedWord($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getBoggleGuessedWord($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateBoggleGuessedWord(BoggleGuessedWord $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteBoggleGuessedWord($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getBoggleGuessedWords($from, $limit) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countBoggleGuessedWords() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("BoggleGuessedWordPersistence");
	}

}
?>