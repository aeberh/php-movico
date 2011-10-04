<?php
class Img extends Component {
	
	const PATH = "/www/img";
	
	private $src;
	private $popup;
	private $alt;
	
	public function setSrc($src) {
		$this->src = $src;
	}
	
	public function setPopup($popup) {
		$this->popup = $popup;
	}
	
	public function setAlt($alt) {
		$this->alt = $alt;
	}
	
	public function doRender($index=null) {
		$popup = $this->getConvertedValue($this->popup, $index);
		$alt = $this->getConvertedValue($this->alt, $index);
		$ctx = parent::$settings->getContextPath();
		return "<img id=\"".$this->id."\" title=\"$popup\" alt=\"$alt\" src=\"".$ctx.self::PATH."/".$this->src."\">";
	}
	
	public function getValidParents() {
		return -1;
	}
	
}
?>