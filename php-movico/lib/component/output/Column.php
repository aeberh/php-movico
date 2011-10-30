<?php
class Column extends Component {
	
	public function doRender($index=null) {
		return $this->renderChildren(array(), array("ColHeader"), $index);
	}
	
}