<?
class ViewRenderer {
	
	public function render($view) {
		$comp = $this->parseView($view);
		return $this->renderComponent($comp);
	}
	
	private function parseView($view) {
		$viewXml = "view/$view.xml";
		if(!file_exists($viewXml)) {
			throw new ViewNotExistsException($view);
		}
		$node = new SimpleXMLElement($viewXml, null, true);
		$viewRoot = $this->parseNode($node);
		$viewRoot->setPage($view);
		return $viewRoot;
	}
		
	private function parseNode(SimpleXMLElement $node) {
		$className = ucfirst($node->getName());
		if(!ClassUtil::isSubclassOf($className, "Component")) {
			throw new ComponentNotExistsException($className);
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
			$instance->addChild($this->parseNode($child));
		}
		return $instance;
	}
	
	private function renderComponent($viewComp) {
		if(isset($_GET["jquery"])) {
			return json_encode(array("body"=>$viewComp->renderBodyChildren()));
		} else {
			return $viewComp->render();
		}
	}
	
}
?>