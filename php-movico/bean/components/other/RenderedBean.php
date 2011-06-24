<?php
class RenderedBean extends RequestBean {
	
	private $checked = false;
	
	public function isChecked() {
		return $this->checked;
	}
	
	public function setChecked($checked) {
		$this->checked = $checked;
	}
	
	public function submit() {
		return null;
	}
	
}
?>