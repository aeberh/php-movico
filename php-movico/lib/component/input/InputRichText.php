<?php
class InputRichText extends Component {
	
	private $value;
	private $toolbar;
	private $width;
	private $height;
	private $fileBrowser = "true";
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function getToolbar() {
		return $this->toolbar;
	}
	
	public function setToolbar($toolbar) {
		$this->toolbar = $toolbar;
	}
	
	public function setFileBrowser($fileBrowser) {
		$this->fileBrowser = $fileBrowser;
	}
	
	public function getHeight() {
		return $this->height;
	}
	
	public function setHeight($height) {
		$this->height = $height;
	}
	
	public function getWidth() {
		return $this->width;
	}
	
	public function setWidth($width) {
		$this->width = $width;
	}
	
	public function doRender($index=null) {
		$toolbar = $this->getConvertedValue($this->toolbar, $index);
		$value = $this->getConvertedValue($this->value, $index);
		$height = $this->getConvertedValue($this->height, $index);
		$width = $this->getConvertedValue($this->width, $index);
		$name = $this->value;
		$id = $this->id;
		$lang = parent::$settings->getLocale();
		return "<textarea id=\"$id\" name=\"$name\" class=\"inputRichText\" toolbar=\"$toolbar\" lang=\"$lang\" height=\"$height\" width=\"$width\">$value</textarea>";
	}
	
}
?>