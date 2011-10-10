<?php
class FileUpload extends Component {

	private $value;
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function doRender($index=null) {
		return "<input type=\"file\" name=\"".$this->value."\"/>";
	}
	
}
?>