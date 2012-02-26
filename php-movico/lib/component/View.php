<?php
class View extends Component {
	
	private $url;
	private $title;
	private $description;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function doRender($index=null) {
		$ajax = parent::$settings->isAjaxEnabled();
		$gmapsApiKey = parent::$settings->getGmapsApiKey();
		$context = parent::$settings->getContextPath();
		$locale = parent::$settings->getLocale();
		$title = $this->getPageTitle();
		$description = $this->getPageDesc();
		$result = "<!DOCTYPE HTML>".
			"<html>\n\t<head>\n\t\t<title>$title</title>\n".
			"<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\" />\n".
			"<meta name=\"description\" content=\"$description\">\n".
			"<link rel=\"stylesheet\" href=\"$context/lib/javascript/ui-lightness/jquery-ui-1.8.18.custom.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\">\n".
			"<link rel=\"stylesheet\" href=\"$context/lib/component/input/elrte-1.3/css/elrte.min.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\">\n".
			"<link rel=\"stylesheet\" href=\"$context/lib/component/input/elfinder-1.2/css/elfinder.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\">\n".
			"<script type=\"text/javascript\" src=\"$context/lib/javascript/jquery-1.7.1.min.js\"></script>\n".
			"<script type=\"text/javascript\" src=\"$context/lib/javascript/jquery-ui-1.8.18.custom.min.js\"></script>\n".
			"<script type=\"text/javascript\" src=\"$context/lib/component/input/elrte-1.3/js/elrte.min.js\"></script>\n".
			"<script type=\"text/javascript\" src=\"$context/lib/component/input/elrte-1.3/js/i18n/elrte.$locale.js\"></script>\n".
			"<script type=\"text/javascript\" src=\"$context/lib/component/input/elfinder-1.2/js/elfinder.min.js\"></script>\n".
			"<script type=\"text/javascript\" src=\"$context/lib/component/input/elfinder-1.2/js/i18n/elfinder.$locale.js\"></script>\n".
			"<script type=\"text/javascript\" src=\"$context/lib/javascript/forms.js\"></script>\n";
		if(parent::$settings->isGmapsEnabled()) {
			$result .= "<script src=\"http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=$gmapsApiKey&amp;hl=nl\" type=\"text/javascript\"></script>\n";
		}
		$result .= "<script type=\"text/javascript\">\n".
			"$(function() {\n";
		$ajaxTimeout = parent::$settings->getAjaxTimeout();
		$ctx = parent::$settings->getContextPath();
		if($ajax) {
			$result .= "registerForms('$ajaxTimeout', '$ctx');\n";
		}
		$ajaxJs = $ajax ? "true" : "false";
		$result .= "
				startupActions('$ctx', $ajaxJs);\n
			});\n
		</script>\n";
		$result .= $this->renderHeadChildren();
		$result .= "\t</head>\n\t<body>\n\n".$this->renderBodyChildren($title);
		if($ajax) {
			$result .= $this->renderIframeReplace();
		}
		return $result."\t</body>\n</html>";
	}
	
	private function renderHeadChildren() {
		return $this->renderChildren(array("Css", "Js"));
	}
	
	public function renderBodyChildren() {
		return $this->renderChildren(array(), array("Css", "Js")).
			"<span style=\"display:none\" id=\"MovicoView\">".parent::$settings->getContextPath()."/".$this->url."</span>".
			"<span style=\"display:none\" id=\"MovicoPageTitle\">".$this->getPageTitle()."</span>".
			"<span style=\"display:none\" id=\"MovicoPageDescription\">".$this->getPageDesc()."</span>";
	}
	
	private function renderIframeReplace() {
		return "<script type=\"text/javascript\">".
			"$(\"body\", window.parent.document).html($(\"body\").html());".
			"</script>";
	}
	
	private function getPageTitle() {
		$configTitle = parent::$settings->getTitle();
		$result = "";
		if(!empty($this->title)) {
			$result .= $this->getConvertedValue($this->title);
		}
		if(!empty($this->title) && !empty($configTitle)) {
			$result .= " - ";
		}
		if(!empty($configTitle)) {
			$result .= $configTitle;
		}
		return $result;
	}
	
	private function getPageDesc() {
		return $this->getConvertedValue($this->description);
	}
	
	public function setDescription($description) {
		$this->description = $description;
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function setUrl($url) {
		$this->url = $url;
	}
	
	public function getUrl() {
		return $this->url;
	}
	
}
?>