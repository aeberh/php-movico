<?php
class PingpongClubServiceBase {

	public function findByName($name, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByName($name, $from, $limit);
	}

	public function deleteByName($name) {
		$this->getPersistence()->deleteByName($name);
	}

	public function findByShortName($shortName, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByShortName($shortName, $from, $limit);
	}

	public function deleteByShortName($shortName) {
		$this->getPersistence()->deleteByShortName($shortName);
	}

	public function findByNumber($number, $from=-1, $limit=-1) {
		return $this->getPersistence()->findByNumber($number, $from, $limit);
	}

	public function deleteByNumber($number) {
		$this->getPersistence()->deleteByNumber($number);
	}

	public function createPingpongClub($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getPingpongClub($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updatePingpongClub(PingpongClub $object) {
		return $this->getPersistence()->update($object);
	}

	public function deletePingpongClub($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getPingpongClubs($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countPingpongClubs() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("PingpongClubPersistence");
	}

}
?>