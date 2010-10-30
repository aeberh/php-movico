<?
class Css extends Component {
	
	const PATH = "www/css/";
	
	private $src;
	
	public function setSrc($src) {
		$this->src = $src;
	}
	
	public function doRender($index=null) {
		return "<link rel=\"stylesheet\" type=\"text/css\" href=\"".self::PATH.$this->src."\">";
	}
	
	public function getValidParents() {
		return array("View");
	}
	
}
?>