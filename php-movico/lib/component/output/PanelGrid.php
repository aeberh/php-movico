<?php
class PanelGrid extends Component {
	
	private $columns;
	private $columnClasses = array();
	
	public function doRender($index=null) {
		$result = "<table cellspacing=\"0\" cellpadding=\"0\" class=\"panelGrid\"><tr>";
		for($i=0; $i<count($this->children); $i++) {
			$result .= "<td".$this->getColClass($i).">".$this->children[$i]->render()."</td>";
			if(($i+1)%$this->columns === 0) {
				$result .= "</tr><tr>";
			}
		}
		return $result."</tr></table>";
	}

	public function setColumns($columns) {
		$this->columns = $columns;
	}
	
	public function setColumnClasses($columnClasses) {
		$this->columnClasses = explode(",", $columnClasses);
	}
	
	private function getColClass($i) {
		if(count($this->columnClasses) == 0) {
			return "";
		}
		$index = $i % count($this->columnClasses);
		return " class=\"".$this->columnClasses[$index]."\"";
	}
	
}
?>