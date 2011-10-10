<?php
class OutputEmail extends Component {

	private $value;
	private $link;

	public function doRender($index=null) {
		$value = $this->getConvertedValue($this->value);
		$email = str_replace("#","", $value);
		$obfEmail = "";
		for($i=0; $i<strlen($email); $i++) {
			$obfEmail .= "&#".ord($email[$i]);
		}
		$isLink = $this->link === "true";
		return ($isLink ? "<a href=\"mailto:$obfEmail\"" : "<span") . 
			" id=\"{$this->id}\" class=\"{$this->class}\">" . $obfEmail .
			($isLink ? "</a>" : "</span>");
	}

	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setLink($link) {
		$this->link = $link;
	}
	
}
?>