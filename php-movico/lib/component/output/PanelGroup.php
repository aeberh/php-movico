<?php
class PanelGroup extends Component {
	
	public function doRender($rowIndex=null) {
		return $this->renderChildren(array(), array(), $rowIndex);
	}
	
}
?>