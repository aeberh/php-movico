<?
class Js extends Component {
	
	private $src;
	
	public function setSrc($src) {
		$this->src = $src;
	}
	
	public function render() {
		return "<script language=\"Javascript\" type=\"text/javascript\" src=\"".$this->src."\"></script>";
	}
	
	public function getValidParents() {
		return array("View");
	}
	
}