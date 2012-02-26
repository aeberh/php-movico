<?php
class BuildingBean extends RequestBean {
	
	private $building;
	
	public function __construct() {
		$this->building = new Building();
	}
	
	public function getBuildings() {
		return BuildingServiceUtil::getBuildings();
	}
	
	public function getBuilding() {
		return $this->building;
	}
	
	public function create() {
		BuildingServiceUtil::updateBuilding($this->building);
		return null;
	}
	
}
?>