<?php
class ViewRenderer extends ApplicationBean {
	
	private $xmlFactory;
	private $settings;
	
	public function __construct() {
		$this->xmlFactory = Singleton::create("DOMXmlFactory");
		$this->settings = Singleton::create("Settings");
	}
	
	public function render(ViewForward $forward) {
		$comp = $this->getViewRoot($forward);
		$out = $this->renderComponent($comp);
		return $out;
	}
	
	private function getViewRoot(ViewForward $forward) {
		//if($this->cacheEnabled && $this->getViewCache()->has($url)) {
		//	return $this->getViewCache()->get($url);
		//}
		$viewName = $forward->getView();
		$location = $this->getViewLocation($viewName);
		if(!file_exists($location)) {
			$location = $this->getViewLocation($this->settings->getErrorPage());
			if(!file_exists($location)) {
				throw new ViewNotExistsException($view);
			}
		}
		$doc = $this->xmlFactory->fromFile($location);
		$result = $doc->getRootElement();
		while($result->getName() == "composition") {
			$result = $this->parseTemplate($result);
		}
		$result = $this->parseView($forward->getUrl(), $result);
		//if($this->cacheEnabled) {
		//	$this->getViewCache()->put($url, $result);
		//}
		return $result;
	}
	
	private function parseView($url, XmlElement $root) {
		$viewRoot = $this->parseNode($root);
		$viewRoot->setUrl($url);
		return $viewRoot;
	}
		
	private function parseNode(XmlElement $node) {
		$className = ucfirst($node->getName());
		if(!ClassCache::exists($className)) {
			$instance = new HtmlComponent($node->getName(), $node->getText(), $node->getAttributes());
		} else {
			if(!ClassUtil::isSubclassOf($className, "Component")) {
				throw new ComponentNotExistsException($className);
			}
			$instance = new $className;
			foreach($node->getAttributes() as $attrName=>$attrValue) {
				$setterName = "set".ucfirst($attrName);
				$setter = new ReflectionMethod($instance, $setterName);
				$setter->invoke($instance, (string)$attrValue);
			}
		}
		foreach($node->getChildren() as $child) {
			$instance->addChild($this->parseNode($child));
		}
		return $instance;
	}
	
	private function renderComponent(Component $viewComp) {
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
	
	private function parseTemplate(XmlElement $composition) {
		$templateName = $composition->getAttribute("template");
		$title = $composition->getAttribute("title");
		$description = $composition->getAttribute("description");
		$tplXml = $this->getTemplateLocation($templateName);
		if(!file_exists($tplXml)) {
			throw new TemplateNotExistsException($templateName);
		}
		$replaces = array();
		foreach($composition->getChildren() as $define) {
			$key = "<insert name=\"{$define->getAttribute("name")}\"/>";
			$replaces[$key] = $define->asXmlChildren();
		}
		
		$tplNode = $this->xmlFactory->fromFile($tplXml)->getRootElement();
		$result = $tplNode->asXml();
		$result = StringUtil::replaceWith($result, "<template>", "<view>");
		$result = StringUtil::replaceWith($result, "</template>", "</view>");
		
		$inserts = $tplNode->getNbDescendants("insert");
		for($i=0; $i<$inserts; $i++) {
			$result = StringUtil::replaceAssoc($result, $replaces);
		}
		$root = $this->xmlFactory->fromString($result)->getRootElement();
		if(!is_null($title)) {
			$root->addAttribute("title", $title);
		}
		if(!is_null($description)) {
			$root->addAttribute("description", $description);
		}
		return $root;
	}
	
	private function getViewLocation($viewName) {
		return "www/view/$viewName.xml";
	}
	
	private function getTemplateLocation($templateName) {
		return "www/template/$templateName.xml";
	}
	
	private function getViewCache() {
		return BeanLocator::get("ViewCache")->getCache();
	}
	
}
?>