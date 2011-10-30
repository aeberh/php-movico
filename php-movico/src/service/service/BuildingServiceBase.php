<?php
class BuildingServiceBase {

	public function createBuilding($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getBuilding($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateBuilding(Building $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteBuilding($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getBuildings($from=0, $limit=9999999999) {
		return $this->getPersistence()->findAll($from, $limit);
	}

	public function countBuildings() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("BuildingPersistence");
	}

}
?>