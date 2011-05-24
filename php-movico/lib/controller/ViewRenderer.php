<?
class ViewRenderer extends ApplicationBean {
	
	public function render($view) {
		$comp = $this->parseView($view);
		return $this->renderComponent($comp);
	}
	
	private function parseView($view) {
		$viewXml = "www/view/$view.xml";
		if(!file_exists($viewXml)) {
			throw new ViewNotExistsException($view);
		}
		$node = new SimpleXMLElement($viewXml, null, true);
		if($node->getName() == "composition") {
			$node = $this->parseTemplate($node);
		}
		$viewRoot = $this->parseNode($node);
		$viewRoot->setPage($view);
		return $viewRoot;
	}
		
	private function parseNode(SimpleXMLElement $node) {
		$className = ucfirst($node->getName());
		if(!class_exists($className)) {
			$instance = new HtmlComponent($node->getName(), strval($node), $node->attributes());
		} else {
			if(!ClassUtil::isSubclassOf($className, "Component")) {
				throw new ComponentNotExistsException($className);
			}
			$instance = new $className;
			foreach($node->attributes() as $attrName=>$attrValue) {
				$setterName = "set".ucfirst($attrName);
				$setter = new ReflectionMethod($instance, $setterName);
				$setter->invoke($instance, (string)$attrValue);
			}
		}
		foreach($node->children() as $child) {
			$instance->addChild($this->parseNode($child));
		}
		return $instance;
	}
	
	private function renderComponent($viewComp) {
		if(isset($_GET["jquery"])) {
			return StringUtil::getJson("body", $viewComp->renderBodyChildren());
		}
		$view = $viewComp->render();
		if(isset($_GET["file"])) {
			$view .= $this->jsRewriteParent();
		}
		return $view;
	}
	
	private function jsRewriteParent() {
		return "<script type=\"text/javascript\">".
			"$(function() {window.parent.body.innerHTML=document.body.innerHTML;});".
			"</script>";
	}
	
	private function parseTemplate(SimpleXMLElement $composition) {
		$template = $composition->attributes()->template;
		$tplXml = "www/template/$template.xml";
		if(!file_exists($tplXml)) {
			throw new TemplateNotExistsException($template);
		}
		$replaces = array();
//		foreach($composition->children() as $define) {
//			$key = $define->attributes()->name;
//			$replaces[(string)$key] = $this->getChildrenAsXml($define);
//		}
//		
//		$tplNode = new SimpleXMLElement($tplXml, null, true);
//		$viewNode = new SimpleXMLElement("<view></view>");
//		
//		$this->doParse($tplNode, $viewNode, $replaces);
//		return $viewNode;
//		
//		$inserts = count($tplNode->xpath("//insert"));
//		
//		$result = $tplNode->asXml();
//		for($i=0; $i<$inserts; $i++) {
//			$result = StringUtil::replaceAssoc($result, $replaces);
//		}
//		
//		$viewNode = new SimpleXMLElement($result);
//		$viewNode->template = "view";
//		return $viewNode;
		foreach($composition->children() as $define) {
			$key = "<insert name=\"{$define->attributes()->name}\"/>";
			$replaces[$key] = $this->getChildrenAsXml($define);
		}
		
		$tplNode = new SimpleXMLElement($tplXml, null, true);
		$result = $tplNode->asXml();
		$result = StringUtil::replaceWith($result, "<template>", "<view>");
		$result = StringUtil::replaceWith($result, "</template>", "</view>");
		
		$inserts = count($tplNode->xpath("//insert"));
		for($i=0; $i<$inserts; $i++) {
			$result = StringUtil::replaceAssoc($result, $replaces);
		}
		return new SimpleXMLElement($result);
	}
	
//	private function doParse(SimpleXMLElement $tplNode, SimpleXMLElement &$viewNode, $replaces, SimpleXMLElement &$result) {
//		if($tplNode->getName() == "insert") {
//			$contentXml = $replaces[(string)$tplNode->attributes()->name];
//			$viewChild = new SimpleXMLElement($contentXml);
//			$childNode = $result->addChild($viewChild->getName(), $contentXml);
//		} else {
////			$childNode = $viewNode;
////			if($tplNode->getName() != "template") {
////				$childNode = $viewNode->addChild($tplNode->getName());
////			}
//			$childNode = $result->addChild($tplNode->getName());
//			foreach($tplNode->children() as $tplChild) {
//				$this->doParse($tplChild, $childNode, $replaces, $result);
//			}
//		}
//	}
	
	private function getChildrenAsXml(SimpleXMLElement $parent) {
		$result = "";
		foreach($parent->children() as $child) {
			$result .= $child->asXML();
		}
		return $result;
	}
	
}
?>