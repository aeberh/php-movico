<?php
class DropdownSubmitBean extends RequestBean {
	
	private $selectedOption;
	private $message;
	private $options = array("Alfa", "Beta", "Gamma");
	
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
	
	public function showSelected() {
		$this->message = $this->options[$this->selectedOption]." was selected!";
		return null;
	}
	
}
?>