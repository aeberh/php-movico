<?php
abstract class BuildingModel extends Model {

	protected $buildingId;

	public function getBuildingId() {
		return $this->buildingId;
	}

	public function setBuildingId($buildingId) {
		$this->buildingId = $buildingId;
	}

	protected $name;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

}
?>