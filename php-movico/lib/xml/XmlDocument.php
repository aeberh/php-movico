<?php
class XmlDocument {
	
	private $root;
	
	private function __construct($dom) {
		$this->root = $this->getXmlElement($dom->documentElement);
	}
	
	private function getXmlElement(DOMElement $el) {
		$result = new XMLElement(String::create($el->tagName));
		for($i=0; $i<$el->childNodes->length; $i++) {
			$child = $el->childNodes->item($i);
			if($child instanceof DOMText) {
				$result->setText(String::create($child->textContent));
			} elseif($child instanceof DOMElement) {
				$xmlChild = $this->getXmlElement($child);
				$xmlChild->setParent($result);
				$result->addChild($xmlChild);
			}
		}
		for($i=0; $i<$el->attributes->length; $i++) {
			$attr = $el->attributes->item($i);
			$result->addAttribute($attr->nodeName, $attr->nodeValue);
		}
		return $result;
	}
	
	public static function fromString($string) {
		$dom = new DOMDocument();
		$dom->loadXml($string);
		return new XmlDocument($dom);
	}
	
	public static function fromFile($file) {
		$dom = new DOMDocument();
		$dom->load($file);
		return new XmlDocument($dom);
	}
	
	public function getRootElement() {
		return $this->root;
	}
	
}
?>