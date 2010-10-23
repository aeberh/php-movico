<?
class DataTable extends Component {
	
	private $value;
	private $var;
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setVar($var) {
		$this->var = $var;
	}
	
	public function getVar() {
		return $this->var;
	}
	
	public function getValue() {
		return $this->value;
	}
	
	public function render($index=null) {
		$cols = $this->getChildrenOfType("Column");
		$result = "<table cellspacing=\"0\" cellpadding=\"0\">";
		$result .= $this->renderHeader($cols);
		$result .= $this->renderRows($cols);
		return $result."</table>";
	}

	private function renderHeader($cols) {
		$result = "<tr>";
		foreach($cols as $col) {
			$result .= $col->renderChildren(array("ColHeader"));
		}
		return $result."</tr>";
	}
	
	private function renderRows($cols) {
		$rows = BeanUtil::getProperty($this->value);
		$result = "";
		foreach($rows as $row) {
			$result .= "<tr>";
			foreach($cols as $col) {
				$result .= "<td>".$col->render($row)."</td>";
			}
			$result .= "</tr>";
		}
		return $result;
	}
	
	public function getValidParents() {
		return array("View", "PanelGrid", "Form");
	}
	
}
?>