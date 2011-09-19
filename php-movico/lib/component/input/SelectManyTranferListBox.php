<?php
class SelectManyTransferListBox extends SelectManyListBox {
	
	public function doRender($rowIndex=null) {
		$name = $this->value;
		$val = $this->getConvertedValue($name, $rowIndex);
		if(is_null($val)) {
			$val = array();
		}
		$optionList = $this->getConvertedValue($this->options, $rowIndex);
		$result = "<table cellspacing=\"0\" cellpadding=\"0\"><tr><td><select multiple=\"multiple\">";
		foreach($optionList as $oValue=>$oLabel) {
			if(!in_array($oValue, $val)) {
				$result .= "<option value=\"$oValue\">$oLabel</option>";
			}
		}
		$result.="</select></td>".
			"<td><button>&lt;&lt;</button><br/><button>&lt;</button><br/><button>&gt;</button><br/><button>&gt;&gt;</button></td>".
			"<td><select multiple=\"multiple\">";
		reset($optionList);
		foreach($optionList as $oValue=>$oLabel) {
			if(in_array($oValue, $val)) {
				$result .= "<option value=\"$oValue\">$oLabel</option>";
			}
		}
		return "$result</select></td></tr></table>";
	}
	
}
?>