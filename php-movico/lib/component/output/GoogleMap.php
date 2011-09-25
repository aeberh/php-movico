<?php
class GoogleMap extends Component {
	
	const DEFAULT_HEIGHT = 200;
	const DEFAULT_WIDTH = 300;
	const DEFAULT_ZOOM = 13;
	
	private $address;
	private $height;
	private $width;
	private $zoomLevel;
	
	public function doRender($index=null) {
		if(!parent::$settings->isGmapsEnabled()) {
			return "";
		}
		$address = $this->getConvertedValue($this->address, $index);
		$height = empty($this->height) ? self::DEFAULT_HEIGHT : $this->getConvertedValue($this->height, $index);
		$width = empty($this->width) ? self::DEFAULT_WIDTH : $this->getConvertedValue($this->width, $index);
		$zoom = empty($this->zoomLevel) ? self::DEFAULT_ZOOM : $this->getConvertedValue($this->zoomLevel, $index);
		return "<div style=\"width: {$width}px; height: {$height}px\" class=\"googleMap\" id=\"".$this->id."\" address=\"$address\" zoom=\"$zoom\"></div>";
	}
	
	public function getValidParents() {
		return -1;
	}
	
	public function setAddress($address) {
		$this->address = $address;
	}
	
	public function setHeight($height) {
		$this->height = $height;
	}
	
	public function setWidth($width) {
		$this->width = $width;
	}
	
	public function setZoomLevel($zoomLevel) {
		$this->zoomLevel = $zoomLevel;
	}
	
}
?>