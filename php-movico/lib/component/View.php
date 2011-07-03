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
		$result = "<html>\n\t<head>\n\t\t<title>".$this->title."</title>\n".
			"<script type=\"text/javascript\" src=\"lib/javascript/jquery-1.6.1.min.js\"></script>".
			"<script type=\"text/javascript\" src=\"lib/javascript/forms.js\"></script>".
			"<script type=\"text/javascript\" src=\"lib/component/input/ckeditor/ckeditor.js\"></script>";
		if($ajax) {
			$ajaxTimeout = Singleton::create("Settings")->getAjaxTimeout();
			$result .= <<<TST
		<script type="text/javascript">
			$(function() {
				registerForms('$ajaxTimeout');
			});	
		</script>
TST;
		}
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