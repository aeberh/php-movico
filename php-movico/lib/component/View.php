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
		$title = $this->getPageTitle();
		$description = $this->getPageDesc();
		$result = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">".
			"<html>\n\t<head>\n\t\t<title>$title</title>\n".
			"<meta http-equiv=\"content-type\" content=\"text/html;charset=UTF-8\" />\n".
			"<meta name=\"description\" content=\"$description\">\n".
			"<script type=\"text/javascript\" src=\"$context/lib/javascript/jquery-1.6.4.min.js\"></script>".
			"<script type=\"text/javascript\" src=\"$context/lib/javascript/forms.js\"></script>";
		if(parent::$settings->isGmapsEnabled()) {
			$result .= "<script src=\"http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=$gmapsApiKey&amp;hl=nl\" type=\"text/javascript\"></script>";
		}
		$result .= "<script type=\"text/javascript\">".
			"$(function() {";
		$ajaxTimeout = parent::$settings->getAjaxTimeout();
		$ctx = parent::$settings->getContextPath();
		if($ajax) {
			$result .= "registerForms('$ajaxTimeout', '$ctx');";
		}
		$ajaxJs = $ajax ? "true" : "false";
		$result .= "
				startupActions('$ctx', $ajaxJs);
				//unloadHtmlAreas();
			});
		</script>";
		$result .= $this->renderHeadChildren();
		$result .= "\t</head>\n\t<body>\n\n".$this->renderBodyChildren($title);
		if($ajax) {
			$result .= $this->renderIframeReplace();
		}
		return $result."\t</body></html>";
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