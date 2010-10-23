<?
class ColHeader extends Component {
	
	public function render($index=null) {
		return "<th>".$this->renderChildren()."</th>";
	}
	
	public function getValidParents() {
		return array("Column");
	}
	
}
?>