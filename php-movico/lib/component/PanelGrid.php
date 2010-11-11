<?
class PanelGrid extends Component {
	
	private $columns;
	
	public function doRender($index=null) {
		$result = "<table cellspacing=\"0\" cellpadding=\"0\"><tr>";
		for($i=0; $i<count($this->children); $i++) {
			$result .= "<td valign='top'>".$this->children[$i]->render()."</td>";
			if(($i+1)%$this->columns === 0) {
				$result .= "</tr><tr>";
			}
		}
		return $result."</tr></table>";
	}

	public function setColumns($columns) {
		$this->columns = $columns;
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGroup");
	}
	
}
?>