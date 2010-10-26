<?
class View extends Component {
	
	private $title;
	private $page;
	
	const DEFAULT_VIEW = "index";
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function render($index=null) {
		$ajax = SettingsUtil::isAjaxEnabled();
		$result = "<html>\n\t<head>\n\t\t<title>".$this->title."</title>\n";
		if($ajax) {
			$result .= <<<TST
		<script type="text/javascript" src="lib/jquery/jquery-1.4.3.min.js"></script>
		<script type="text/javascript">
			$(function() {
				registerForms();
				function registerForms() {
					$("form").submit(function() {
						$.post("index.php?jquery=1", $(this).serialize(),
						function(data) {
							$("body").html(data.body);
							registerForms();
						}, "json");
						return false;
					});
				}
			});	
		</script>
TST;
		}
		$result .= $this->renderHeadChildren();
		$result .= "\t</head>\n\t<body>\n\t\t<div id=\"content\">\n";
		$result .= $this->renderBodyChildren();
		return $result."\t\t</div>\n\t</body>\n</html>";
	}
	
	public function renderHeadChildren() {
		return $this->renderChildren(array("Css", "Js"));
	}
	
	public function renderBodyChildren() {
		return $this->renderChildren(array(), array("Css", "Js"));
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