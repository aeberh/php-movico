<?
class Img extends Component {
	
	const PATH = "/www/img";
	
	private $src;
	private $popup;
	
	public function setSrc($src) {
		$this->src = $src;
	}
	
	public function setPopup($popup) {
		$this->popup = $popup;
	}
	
	public function doRender($index=null) {
		$popup = $this->getConvertedValue($this->popup, $index);
		$ctx = parent::$settings->getContextPath();
		$theme = empty($theme) ? "" : "/$theme";
		return "<img id=\"".$this->id."\" title=\"$popup\" src=\"".$ctx.self::PATH.$theme."/".$this->src."\">";
	}
	
	public function getValidParents() {
		return -1;
	}
	
}
?>