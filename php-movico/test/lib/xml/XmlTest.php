<?php
class XmlTest extends UnitTestCase {
	
	public function testDOMXmlFactory() {
		$this->verifyXmlContents(Singleton::create("DOMXmlFactory"));
	}
	
	public function testSimpleXmlFactory() {
		$this->verifyXmlContents(Singleton::create("SimpleXmlFactory"));
	}
	
	private function verifyXmlContents(XmlFactory $xmlFactory) {
		$xmlString = "<root><element1 attribute1=\"value1\" attribute2=\"value2\"/><element2><child>bla</child></element2></root>";
		
		$file = $xmlFactory->fromString(String::create($xmlString));
		$this->assertEqual("root", $file->getRootElement()->getName());
		$root = $file->getRootElement();
		$this->assertEqual(2, $root->getNbChildren());
		$this->assertEqual(1, $root->getNbChildren("element1"));
		$children = $root->getChildren();
		
		$el1 = $children->getFirst();
		$this->assertEqual("element1", $el1->getName());
		$this->assertEqual(2, $el1->getNbAttributes());
		$this->assertEqual("value1", $el1->getAttribute("attribute1"));
		$this->assertEqual("value2", $el1->getAttribute("attribute2"));
		
		$el2 = $children->getLast();
		$this->assertEqual("element2", $el2->getName());
		$child = $el2->getChildren()->getFirst();
		$this->assertEqual("bla", $child->getText());
		
		$this->assertEqual("element2", $child->getParent()->getName());
		
		$this->assertEqual($xmlString, $root->asXml());
		$this->assertEqual(1, $root->getNbDescendants("child"));
	}
	
}
?>