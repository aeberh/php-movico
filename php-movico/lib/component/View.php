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
			$timeout = Singleton::create("Settings")->getAjaxTimeout();
			$result .= <<<TST
		<script type="text/javascript">
			$(function() {
				registerForms();
				function registerForms() {
					$("form").submit(function() {
						$("button").attr("disabled", "disabled");
						$("img.AjaxLoading").attr("src", "lib/component/img/connect_active.gif");
						
						$.ajax({
							url: "index.php?jquery=1",
							data: $(this).serialize(),
							type: "POST",
							dataType: "json",
							timeout: $timeout,
							success: function(data) {
								$("body").html(data.body);
								registerForms();
								$("img.AjaxLoading").attr("src", "lib/component/img/connect_idle.gif");
								autoFocus();
							},
							error: function(request, errorType, errorThrown) {
								$("button").removeAttr("disabled");
								if(errorType == "timeout") {
									$("img.AjaxLoading").attr("src", "lib/component/img/connect_caution.gif");
								} else {
									$("img.AjaxLoading").attr("src", "lib/component/img/connect_disconnected.gif");
								}
							}
						});
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