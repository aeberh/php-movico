<?
class PanelGroup extends Component {
	
	public function doRender($rowIndex=null) {
		return "<div id=\"".$this->id."\">".$this->renderChildren()."</div>";
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "ColHeader", "PanelGroup", "div");
	}
	
}
?>