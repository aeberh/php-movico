<?
class View extends Component {
	
	private $title;
	private $page;
	
	const DEFAULT_VIEW = "index";
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function doRender($index=null) {
		$ajax = Singleton::create("Settings")->isAjaxEnabled();
		$gmapsApiKey = Singleton::create("Settings")->getGmapsApiKey();
		$result = "<html>\n\t<head>\n\t\t<title>".$this->title."</title>\n".
			"<script type=\"text/javascript\" src=\"lib/javascript/jquery-1.6.1.min.js\"></script>".
			"<script type=\"text/javascript\" src=\"lib/javascript/forms.js\"></script>".
			"<script type=\"text/javascript\" src=\"lib/component/input/ckeditor/ckeditor.js\"></script>".
			"<script src=\"http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=$gmapsApiKey&amp;hl=nl\" type=\"text/javascript\"></script>".
			"<script src=\"http://maps.gstatic.com/intl/nl_ALL/mapfiles/357c/maps2.api/main.js\" type=\"text/javascript\"></script>".
		"<script type=\"text/javascript\">".
			"$(function() {";
		$ajaxTimeout = Singleton::create("Settings")->getAjaxTimeout();
		if($ajax) {
			$result .= "registerForms('$ajaxTimeout');";
		}
		$result .= "
				checkRedirect('$ajaxTimeout');
				startupActions(0);
				setHash();
				unloadHtmlAreas();
			});
		</script>";
		$result .= $this->renderHeadChildren();
		$view = isset($_POST["REDIRECT"]) ? " view=\"".$_POST["REDIRECT"]."\"" : "";
		$result .= "\t</head>\n\t<body$view>\n\n";
		$result .= $this->renderBodyChildren();
		$result .= "\n{$this->renderRedirectForm()}";
		if($ajax) {
			$result .= $this->renderIframeReplace();
		}
		return $result."\t</body>\n</html>";
	}
	
	private function renderHeadChildren() {
		return $this->renderChildren(array("Css", "Js"));
	}
	
	public function renderBodyChildren() {
		return $this->renderChildren(array(), array("Css", "Js"));
	}
	
	private function renderRedirectForm() {
		return "<form id=\"RedirectForm\" action=\"#\" method=\"post\" style=\"display:none\">".
			"<input type=\"hidden\" name=\"REDIRECT\" value=\"\">".
			"<button type=\"Submit\">Dummy</button>".
			"</form>";
	}
	
	private function renderIframeReplace() {
		return "<script type=\"text/javascript\">".
			"$(\"body\", window.parent.document).html($(\"body\").html());".
			"</script>";
	}
	
	public function getValidParents() {
		return array();
	}
	
	public function setPage($page) {
		$this->page = $page;
	}
	
	public function getPage() {
		return $this->page;
	}
	
}
?>