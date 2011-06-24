<?php
class OnChangeSubmitBean extends RequestBean {
	
	private $selectedOption;
	private $message;
	private $options = array("Alfa", "Beta", "Gamma");
	private $checked = false;
	
	public function isChecked() {
		return $this->checked;
	}
	
	public function setChecked($checked) {
		$this->checked = $checked;
	}
	
	public function setSelectedOption($selectedOption) {
		$this->selectedOption = $selectedOption;
	}
	
	public function getSelectedOption() {
		return $this->selectedOption;
	}
	
	public function getOptions() {
		return $this->options;
	}
	
	public function getMessage() {
		return $this->message;
	}
	
	public function submit() {
		$this->message = $this->options[$this->selectedOption]." was selected!";
		return null;
	}
	
}
?>