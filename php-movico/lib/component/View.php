<?
class View extends Component {
	
	private $title;
	private $url;
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function doRender($index=null) {
		$ajax = parent::$settings->isAjaxEnabled();
		$gmapsApiKey = parent::$settings->getGmapsApiKey();
		$context = parent::$settings->getContextPath();
		$result = "<html>\n\t<head>\n\t\t<title>".$this->title."</title>\n".
			"<meta http-equiv=\"content-type\" content=\"text/html;charset=UTF-8\" />\n".
			"<script type=\"text/javascript\" src=\"$context/lib/javascript/jquery-1.6.1.min.js\"></script>".
			"<script type=\"text/javascript\" src=\"$context/lib/javascript/forms.js\"></script>".
			"<script type=\"text/javascript\" src=\"$context/lib/component/input/ckeditor/ckeditor.js\"></script>".
			"<script src=\"http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=$gmapsApiKey&amp;hl=nl\" type=\"text/javascript\"></script>".
			//"<script src=\"http://maps.gstatic.com/intl/nl_ALL/mapfiles/362b/maps2.api/main.js\" type=\"text/javascript\"></script>".
		"<script type=\"text/javascript\">".
			"$(function() {";
		$ajaxTimeout = parent::$settings->getAjaxTimeout();
		$ctx = parent::$settings->getContextPath();
		if($ajax) {
			$result .= "registerForms('$ajaxTimeout', '$ctx');";
		}
		$result .= "
				startupActions('$ctx', true);
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