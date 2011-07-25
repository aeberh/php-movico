<?php
class XmlDocument {
	
	private $root;
	
	public function __construct(XmlElement $root) {
		$this->root = $root;
	}
	
	public function getRootElement() {
		return $this->root;
	}
	
}
?>