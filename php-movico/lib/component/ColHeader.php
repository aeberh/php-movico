<?
class ColHeader extends Component {
	
	public function render() {
		return "<th>".$this->renderChildren()."</th>";
	}
	
	public function getValidParents() {
		return array("Column");
	}
	
}
?>