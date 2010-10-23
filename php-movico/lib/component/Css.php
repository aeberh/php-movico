<?
class Css extends Component {
	
	const PATH = "view/css/";
	
	private $src;
	
	public function setSrc($src) {
		$this->src = $src;
	}
	
	public function render($index=null) {
		return "<link rel=\"stylesheet\" type=\"text/css\" href=\"".self::PATH.$this->src."\">";
	}
	
	public function getValidParents() {
		return array("View");
	}
	
}
?>