<?
class ColHeader extends Component {
	
	public function doRender($index=null) {
		return $this->renderChildren();
	}
	
	public function getValidParents() {
		return array("Column");
	}
	
}
?>