<?php
class BuildingPersistence extends Persistence {

	const TABLE = "movico_building";

	public function findByPrimaryKey($buildingId) {
		if(parent::$dbCache->hasSingle("Building", $buildingId)) {
			return parent::$dbCache->getSingle("Building", $buildingId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE buildingId='".addslashes($buildingId)."'");
		if($result->isEmpty()) {
			throw new NoSuchBuildingException($buildingId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("Building", $buildingId, $result);
		return $result;
	}

	public function create($buildingId) {
		$obj = new Building();
		$obj->setBuildingId($buildingId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($buildingId) {
		$this->findByPrimaryKey($buildingId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE buildingId='".addslashes($buildingId)."'");
		parent::$dbCache->resetEntity('Building');
		parent::$dbCache->resetSingle("Building", $buildingId);
	}

	public function update(Building $object) {
		$q = "UPDATE ".self::TABLE." SET `name`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."' WHERE buildingId='".addslashes($object->getBuildingId())."'";
		$pk = $object->getBuildingId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`name`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`name`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getBuildingId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT buildingId from ".self::TABLE." ORDER BY buildingId DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("Building");
		parent::$dbCache->setSingle("Building", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('Building', $from, $limit)) {
			return parent::$dbCache->getAll('Building', $from, $limit);
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE."  LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('Building', $objects, $from, $limit);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('Building', -1, -1)) {
			return count(parent::$dbCache->getAll('Building', -1, -1));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new Building();
		$result->setNew(false);
		$result->setBuildingId(Singleton::create("NullConverter")->fromDBtoDOM($row["buildingId"]));
		$result->setName(Singleton::create("NullConverter")->fromDBtoDOM($row["name"]));
		return $result;
	}

}
?>