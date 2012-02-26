<?php
class SimpleXmlFactory implements XmlFactory {
	
	private function getXmlElement(SimpleXMLElement $el) {
		$result = new XmlElement(String::create($el->getName()));
		$result->setText(String::create($el));
		foreach ($el->children() as $child) {
			$xmlChild = $this->getXmlElement($child);
			$xmlChild->setParent($result);
			$result->addChild($xmlChild);
		}
		foreach($el->attributes() as $name=>$val) {
			$result->addAttribute($name, (string)$val);
		}
		return $result;
	}
	
	private function create(SimpleXMLElement $el) {
		return new XmlDocument($this->getXmlElement($el));
	}
	
	public function fromString($string) {
		return $this->create(simplexml_load_string($string));
	}
	
	public function fromFile($file) {
		return $this->create(simplexml_load_file($file));
	}
	
}
?>