<?php
class XmlElement {
	
	private $parent;
	private $children;
	private $attributes;
	private $name;
	private $text;
	
	public function __construct(String $name) {
		$this->name = $name;
		$this->children = new ArrayList("XmlElement");
		$this->attributes = new HashMap("string", "string");
	}
	
	public function getParent() {
		return $this->parent;
	}
	
	public function getChildren($tagName="*") {
		if($tagName === "*") {
			return $this->children;
		}
		return $this->getChildrenWithTag($tagName);
	}
	
	public function getNbChildren($tagName="*") {
		return $this->getChildren($tagName)->size();
	}
	
	public function getNbDescendants($tagName="*") {
		$result = $this->getNbChildren($tagName);
		foreach($this->getChildren() as $child) {
			$result += $child->getNbDescendants($tagName);
		}
		return $result;
	}
	
	public function hasChildren($tagName="*") {
		return $this->getNbChildren($tagName) > 0;
	}
	
	public function getAttributes() {
		return $this->attributes;
	}
	
	public function getAttribute($key, $default=null) {
		return $this->attributes->has($key) ? $this->attributes->get($key) : $default;
	}
	
	public function getNbAttributes() {
		return $this->attributes->size();
	}
	
	private function getChildrenWithTag($tagName) {
		$tagNameStr = String::create($tagName);
		$result = new ArrayList("XmlElement");
		foreach($this->children as $child) {
			if($child->getName()->equals($tagNameStr)) {
				$result->add($child);
			}
		}
		return $result;
	}
	
	public function asXml() {
		$result = "<".$this->getName();
		foreach($this->getAttributes() as $key=>$value) {
			$result .= " $key=\"$value\"";
		}
		if(!$this->hasChildren() && !isset($this->text)) {
			return $result."/>";
		}
		$result .= ">";
		if(isset($this->text)) {
			$result .= $this->text;
		}
		$result .= $this->asXmlChildren();
		return "$result</".$this->getName().">";
	}
	
	public function asXmlChildren() {
		$result = "";
		foreach($this->getChildren() as $child) {
			$result .= $child->asXml();
		}
		return $result;
	}
	
	public function setText(String $text) {
		$this->text = $text;
	}
	
	public function setParent(XmlElement $parent) {
		$this->parent = $parent;
	}
	
	public function getText() {
		return $this->text;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function addChild(XmlElement $element) {
		$this->children->add($element);
	}
	
	public function addAttribute($key, $value) {
		$this->attributes->put($key, $value);
	}
	
}
?>