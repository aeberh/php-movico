<?php
class Css extends Component {
	
	const PATH = "/www/css";
	
	private $src;
	
	public function setSrc($src) {
		$this->src = $src;
	}
	
	public function doRender($index=null) {
		$context = parent::$settings->getContextPath();
		return "<link rel=\"stylesheet\" type=\"text/css\" href=\"$context".self::PATH."/".$this->src."\">";
	}
	
	public function getValidParents() {
		return array("View");
	}
	
}
?>