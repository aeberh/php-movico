<?
class Column extends Component {
	
	public function getValidParents() {
		return array("DataTable");
	}
	
	public function render($index=null) {
		return $this->renderChildren(array(), array("ColHeader"), $index);
	}
	
}