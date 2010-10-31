<?
class PanelGroup extends Component {
	
	public function doRender($rowIndex=null) {
		return "<div>".$this->renderChildren()."</div>";
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "ColHeader", "PanelGroup");
	}
	
}
?>