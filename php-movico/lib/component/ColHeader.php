<?
class ColHeader extends Component {
	
	public function doRender($index=null) {
		return "<th>".$this->renderChildren()."</th>";
	}
	
	public function getValidParents() {
		return array("Column");
	}
	
}
?>