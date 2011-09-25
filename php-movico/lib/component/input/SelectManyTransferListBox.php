<?php
class SelectManyTransferListBox extends SelectManyListBox {
	
	public function doRender($rowIndex=null) {
		$name = $this->value;
		$val = $this->getConvertedValue($name, $rowIndex);
		if(is_null($val)) {
			$val = array();
		}
		$optionList = $this->getConvertedValue($this->options, $rowIndex);
		$result = "<div class=\"MovicoTransferListBox\"><select id=\"{$this->id}left\" multiple=\"multiple\">";
		foreach($optionList as $oValue=>$oLabel) {
			if(!in_array($oValue, $val)) {
				$result .= "<option value=\"$oValue\">$oLabel</option>";
			}
		}
		$result.="</select>".
			"<button>&lt;&lt;</button><button>&lt;</button><button>&gt;</button><button>&gt;&gt;</button>".
			"<select id=\"{$this->id}right\" multiple=\"multiple\">";
		reset($optionList);
		foreach($optionList as $oValue=>$oLabel) {
			if(in_array($oValue, $val)) {
				$result .= "<option value=\"$oValue\">$oLabel</option>";
			}
		}
		$result .= "</select><select style=\"display:none;\" id=\"{$this->id}\" name=\"{$name}[]\" multiple=\"multiple\">";
		reset($optionList);
		foreach($optionList as $oValue=>$oLabel) {
			if(in_array($oValue, $val)) {
				$result .= "<option selected=\"selected\" value=\"$oValue\">$oLabel</option>";
			}
		}
		$result .= "</select></div>";
		return $result;
	}
	
}
?>