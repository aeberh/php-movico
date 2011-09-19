<?
class View extends Component {
	
	private $url;
	
	public function doRender($index=null) {
		$ajax = parent::$settings->isAjaxEnabled();
		$gmapsApiKey = parent::$settings->getGmapsApiKey();
		$context = parent::$settings->getContextPath();
		$title = parent::$settings->getTitle();
		$result = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">".
			"<html>\n\t<head>\n\t\t<title>$title</title>\n".
			"<meta http-equiv=\"content-type\" content=\"text/html;charset=UTF-8\" />\n".
			"<script type=\"text/javascript\" src=\"$context/lib/javascript/jquery-1.6.1.min.js\"></script>".
			"<script type=\"text/javascript\" src=\"$context/lib/javascript/forms.js\"></script>".
			"<script type=\"text/javascript\" src=\"$context/lib/component/input/ckeditor/ckeditor.js\"></script>".
			"<script src=\"http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=$gmapsApiKey&amp;hl=nl\" type=\"text/javascript\"></script>".
		"<script type=\"text/javascript\">".
			"$(function() {";
		$ajaxTimeout = parent::$settings->getAjaxTimeout();
		$ctx = parent::$settings->getContextPath();
		if($ajax) {
			$result .= "registerForms('$ajaxTimeout', '$ctx');";
		}
		$startupActions = $ajax ? "true" : "false";
		$result .= "
				startupActions('$ctx', $startupActions);
				unloadHtmlAreas();
			});
		</script>";
		$result .= $this->renderHeadChildren();
		$result .= "\t</head>\n\t<body>\n\n".$this->renderBodyChildren();
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
			"<span style=\"display:none\" id=\"MovicoView\">".parent::$settings->getContextPath()."/".$this->url."</span>";
	}
	
	private function renderIframeReplace() {
		return "<script type=\"text/javascript\">".
			"$(\"body\", window.parent.document).html($(\"body\").html());".
			"</script>";
	}
	
	public function getValidParents() {
		return array();
	}
	
	public function setUrl($url) {
		$this->url = $url;
	}
	
	public function getUrl() {
		return $this->url;
	}
	
}
?>