<?php
class Img extends Component {
	
	const PATH = "/www/img";
	
	private $src;
	private $tooltip;
	private $alt;
	
	public function setSrc($src) {
		$this->src = $src;
	}
	
	public function setTooltip($tooltip) {
		$this->tooltip = $tooltip;
	}
	
	public function setAlt($alt) {
		$this->alt = $alt;
	}
	
	public function doRender($index=null) {
		$tooltip = $this->getConvertedValue($this->tooltip, $index);
		$alt = $this->getConvertedValue($this->alt, $index);
		$ctx = parent::$settings->getContextPath();
		return "<img id=\"".$this->id."\" title=\"$tooltip\" alt=\"$alt\" src=\"".$ctx.self::PATH."/".$this->src."\">";
	}
	
}
?>