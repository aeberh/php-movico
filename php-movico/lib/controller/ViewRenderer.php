<?
class ViewRenderer extends ApplicationBean {
	
	private $xmlFactory;
	private $cacheEnabled;
	
	public function __construct() {
		$this->xmlFactory = Singleton::create("DOMXmlFactory");
		$this->cacheEnabled = Singleton::create("Settings")->isViewCacheEnabled();
	}
	
	public function render($url) {
		$comp = $this->getViewRoot($url);
		$out = $this->renderComponent($comp);
		return $out;
	}
	
	private function getViewRoot($url) {
		//if($this->cacheEnabled && $this->getViewCache()->has($url)) {
		//	return $this->getViewCache()->get($url);
		//}
		$location = "www/view/$url.xml";
		if(!file_exists($location)) {
			throw new ViewNotExistsException($url);
		}
		$doc = $this->xmlFactory->fromFile($location);
		$result = $doc->getRootElement();
		while($result->getName() == "composition") {
			$result = $this->parseTemplate($result);
		}
		$result = $this->parseView($url, $result);
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
		$chrono = Singleton::create("Chrono");
		$chrono->start();
		$view = $viewComp->render();
		$chrono->stop();
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