<?
class Column extends Component {
	
	public function getValidParents() {
		return array("DataTable");
	}
	
	public function doRender($index=null) {
		return $this->renderChildren(array(), array("ColHeader"), $index);
	}
	
}