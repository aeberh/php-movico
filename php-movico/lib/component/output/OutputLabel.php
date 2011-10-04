<?php
class OutputLabel extends Component {
	
	private $value;
	private $for;
	
	public function doRender($index=null) {
		return "<label for=\"".$this->for."\">".$this->value."</label>";
	}

	public function setValue($value) {
		$this->value = $value;
	}

	public function setFor($for) {
		$this->for = $for;
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "ColHeader", "PanelGroup", "p");
	}
	
}
?>