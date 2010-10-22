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
	
	public function render() {
		$result = "<table cellspacing=\"0\" cellpadding=\"0\">";
		$result .= $this->renderHeader();
		$result .= $this->renderRows();
		return $result."</table>";
	}
	
	private function renderHeader() {
		$cols = $this->getChildrenOfType("Column");
		$result = "<tr>";
		foreach($cols as $col) {
			$result .= $col->renderChildren("ColHeader");
		}
		return $result."</tr>";
	}
	
	private function renderRows() {
		$rows = BeanUtil::getProperty($this->value);
		$result = "";
		foreach($rows as $row) {
			$result .= "<tr></tr>";
		}
		return $result;
	}
	
	public function getValidParents() {
		return array("View", "PanelGrid", "Form");
	}
	
}
?>