<?
class ViewRenderer extends ApplicationBean {
	
	private $xmlFactory;
	private $cacheEnabled;
	
	public function __construct() {
		$this->xmlFactory = Singleton::create("DOMXmlFactory");
		$this->cacheEnabled = Singleton::create("Settings")->isViewCacheEnabled();
	}
	
	public function render($viewForward) {
		$root = $this->getXmlElement($viewForward->getView());
		$comp = $this->parseView($viewForward->getUrl(), $root);
		return $this->renderComponent($comp);
	}
	
	private function getXmlElement($view) {
		if($this->cacheEnabled && $this->getViewCache()->has($view)) {
			return $this->getViewCache()->get($view);
		}
		$location = "www/view/$view.xml";
		if(!file_exists($location)) {
			throw new ViewNotExistsException($view);
		}
		$doc = $this->xmlFactory->fromFile($location);
		$result = $doc->getRootElement();
		while($result->getName() == "composition") {
			$result = $this->parseTemplate($result);
		}
		if($this->cacheEnabled) {
			$this->getViewCache()->put($view, $result);
		}
		return $result;
	}
	
	private function parseView($url, XmlElement $root) {
		$viewRoot = $this->parseNode($root);
		$viewRoot->setUrl($url);
		return $viewRoot;
	}
		
	private function parseNode(XmlElement $node) {
		$className = ucfirst($node->getName());
		if(!class_exists($className)) {
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
	
	private function parseTemplate(XmlElement $composition) {
		$template = $composition->getAttribute("template");
		$tplXml = "www/template/$template.xml";
		if(!file_exists($tplXml)) {
			throw new TemplateNotExistsException($template);
		}
		$replaces = array();
		foreach($composition->getChildren() as $define) {
			$key = "<insert name=\"{$define->getAttribute("name")}\"/>";
			$replaces[$key] = $this->getChildrenAsXml($define);
		}
		
		$tplNode = $this->xmlFactory->fromFile($tplXml)->getRootElement();
		$result = $tplNode->asXml();
		$result = StringUtil::replaceWith($result, "<template>", "<view>");
		$result = StringUtil::replaceWith($result, "</template>", "</view>");
		
		$inserts = $tplNode->getNbDescendants("insert");
		for($i=0; $i<$inserts; $i++) {
			$result = StringUtil::replaceAssoc($result, $replaces);
		}
		return $this->xmlFactory->fromString($result)->getRootElement();
	}
	
	private function getChildrenAsXml(XmlElement $parent) {
		$result = "";
		foreach($parent->getChildren() as $child) {
			$result .= $child->asXML();
		}
		return $result;
	}
	
	private function getViewCache() {
		return BeanLocator::get("ViewCache")->getCache();
	}
	
}
?>