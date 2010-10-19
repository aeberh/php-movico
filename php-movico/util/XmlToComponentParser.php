<?
class XmlToComponentParser {
	
	public function parse(SimpleXMLElement $node) {
		$className = ucfirst($node->getName());
		if(!class_exists($className)) {
			throw new ComponentNotExistsException();
		}
//		if(!class_exists($className)) {
//			$instance = new HtmlComponent($node->getName(), strval($node), $node->attributes());
//		} else {
			$instance = new $className;
			foreach($node->attributes() as $attrName=>$attrValue) {
				$setterName = "set".ucfirst($attrName);
				$setter = new ReflectionMethod($instance, $setterName);
				$setter->invoke($instance, (string)$attrValue);
			}
//		}
		foreach($node->children() as $child) {
			$instance->addChild($this->parse($child));
		}
		return $instance;
	}
	
}
?>