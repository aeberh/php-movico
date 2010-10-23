<?
class Form extends Component {
	
	public function render($index=null) {
		$result = "<form method=\"post\" action=\"index.php\">";
		$result .= $this->renderChildren();
		$result .= "<input type=\"hidden\" name=\"ACTION\"/>";
		return $result."</form>";
	}
	
	public function getValidParents() {
		return array("View", "PanelGrid");
	}
		
}
?>