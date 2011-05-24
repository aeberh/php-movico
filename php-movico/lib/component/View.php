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
			"<script type=\"text/javascript\" src=\"lib/javascript/jquery-1.5.2.min.js\"></script>".
			"<script type=\"text/javascript\" src=\"lib/javascript/forms.js\"></script>";
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
		$result .= "\t</head>\n\t<body>\n\t\t<div id=\"content\">\n";
		$result .= $this->renderBodyChildren();
		return $result."\t\t</div>\n{$this->renderRedirectForm()}\t</body>\n</html>";
	}
	
	private function renderHeadChildren() {
		return $this->renderChildren(array("Css", "Js"));
	}
	
	private function renderBodyChildren() {
		return $this->renderChildren(array(), array("Css", "Js"));
	}
	
	private function renderRedirectForm() {
		return "<form id=\"RedirectForm\" action=\"#\" method=\"post\">".
			"<input type=\"hidden\" name=\"REDIRECT\" value=\"\">".
			"</form>";
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