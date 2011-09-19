<?php
class DatabaseCache extends ApplicationBean {
	
	private $cache = array();
	private $enabled;
	
	const ALL = "All";
	const FINDER = "Finder";
	const SINGLE = "Single";
	
	public function __construct() {
		$this->enabled = Singleton::create("Settings")->isDbCacheEnabled();
	}

	public function getAll($entity, $from, $limit) {
		return $this->cache[$entity][self::ALL][$from][$limit];
	}
	
	public function hasAll($entity, $from, $limit) {
		if(!$this->enabled) {
			return false;
		}
		return isset($this->cache[$entity][self::ALL][$from][$limit]);
	}
	
	public function setAll($entity, $objects, $from, $limit) {
		if(!$this->enabled) {
			return;
		}
		$this->cache[$entity][self::ALL][$from][$limit] = $objects;
		BeanLocator::storeBean($this);
	}
	
	public function resetEntity($entity) {
		if(!$this->enabled) {
			return;
		}
		unset($this->cache[$entity][self::ALL]);
		unset($this->cache[$entity][self::FINDER]);
		BeanLocator::storeBean($this);
	}
	
	public function getFinder($entity, $finderQuery) {
		return $this->cache[$entity][self::FINDER][$finderQuery];
	}
	
	public function hasFinder($entity, $finderQuery) {
		if(!$this->enabled) {
			return false;
		}
		return isset($this->cache[$entity][self::FINDER][$finderQuery]);
	}
	
	public function setFinder($entity, $finderQuery, $objects) {
		if(!$this->enabled) {
			return;
		}
		$this->cache[$entity][self::FINDER][$finderQuery] = $objects;
		BeanLocator::storeBean($this);
	}
	
	public function getSingle($entity, $id) {
		return $this->cache[$entity][self::SINGLE][$id];
	}
	
	public function hasSingle($entity, $id) {
		if(!$this->enabled) {
			return false;
		}
		return isset($this->cache[$entity][self::SINGLE][$id]);
	}
	
	public function setSingle($entity, $id, $object) {
		if(!$this->enabled) {
			return;
		}
		$this->cache[$entity][self::SINGLE][$id] = $object;
		BeanLocator::storeBean($this);
	}
	
	public function resetSingle($entity, $id) {
		if(!$this->enabled) {
			return;
		}
		unset($this->cache[$entity][self::SINGLE][$id]);
		BeanLocator::storeBean($this);
	}
	
	private function getFinderKey($args) {
		if(count($args) == 1) {
			return self::ALL;
		}
		return $args[1];
	}
	
}
?>