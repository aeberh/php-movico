<?
class Form extends Component {
	
	public function render() {
		$result = "<form method=\"post\" action=\"index.php\">";
		foreach($this->children as $child) {
			$result .= $child->render();
		}
		$result .= "<input type=\"hidden\" name=\"ACTION\"/>";
		return $result."</form>";
	}
	
	public function getValidParents() {
		return array("View", "PanelGrid");
	}
		
}
?>