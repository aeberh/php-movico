<?php
class ViewCache extends SessionBean {
	
	private $cache;
	
	public function __construct() {
		$this->cache = new HashMap("string", "XmlElement");
	}
	
	public function getCache() {
		return $this->cache;
	}
	
}
?>