<?php
class DatabaseCache extends ApplicationBean {
	
	private $cache = array();
	
	const ALL = "All";
	const FINDER = "Finder";
	const SINGLE = "Single";

	public function getAll($entity) {
		return $this->cache[$entity][self::ALL];
	}
	
	public function hasAll($entity) {
		return isset($this->cache[$entity][self::ALL]);
	}
	
	public function setAll($entity, $objects) {
		$this->cache[$entity][self::ALL] = $objects;
		BeanLocator::storeBean($this);
	}
	
	public function resetEntity($entity) {
		unset($this->cache[$entity][self::ALL]);
		unset($this->cache[$entity][self::FINDER]);
		BeanLocator::storeBean($this);
	}
	
	public function getFinder($entity, $finderQuery) {
		return $this->cache[$entity][self::FINDER][$finderQuery];
	}
	
	public function hasFinder($entity, $finderQuery) {
		return isset($this->cache[$entity][self::FINDER][$finderQuery]);
	}
	
	public function setFinder($entity, $finderQuery, $objects) {
		$this->cache[$entity][self::FINDER][$finderQuery] = $objects;
		BeanLocator::storeBean($this);
	}
	
	public function getSingle($entity, $id) {
		return $this->cache[$entity][self::SINGLE][$id];
	}
	
	public function hasSingle($entity, $id) {
		return isset($this->cache[$entity][self::SINGLE][$id]);
	}
	
	public function setSingle($entity, $id, $object) {
		$this->cache[$entity][self::SINGLE][$id] = $object;
		BeanLocator::storeBean($this);
	}
	
	public function resetSingle($entity, $id) {
		unset($this->cache[$entity][self::SINGLE][$id]);
		BeanLocator::storeBean($this);
	}
	
	public function getCache() {
		return $this->cache;
	}
	
	private function getFinderKey($args) {
		if(count($args) == 1) {
			return self::ALL;
		}
		return $args[1];
	}
	
}
?>