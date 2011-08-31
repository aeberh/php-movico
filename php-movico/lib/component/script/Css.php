<?
class Css extends Component {
	
	const PATH = "/www/css";
	
	private $src;
	
	public function setSrc($src) {
		$this->src = $src;
	}
	
	public function doRender($index=null) {
		$context = parent::$settings->getContextPath();
		$theme = empty($theme) ? "" : "/$theme";
		return "<link rel=\"stylesheet\" type=\"text/css\" href=\"$context".self::PATH.$theme."/".$this->src."\">";
	}
	
	public function getValidParents() {
		return array("View");
	}
	
}
?>