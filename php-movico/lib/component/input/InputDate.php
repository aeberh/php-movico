<?php
class InputDate extends Component {
	
	const DATE_TRANSFER_FORMAT = "%d-%m-%Y";
	
	private $value;
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function doRender($index=null) {
		$name = $this->value;
		$dateObj = $this->getConvertedValue($name, $index);
		$day = intval($dateObj->format("%d"));
		$month = intval($dateObj->format("%m"));
		$year = intval($dateObj->format("%Y"));
		$val = $dateObj->format(self::DATE_TRANSFER_FORMAT);
		return $this->ascList("d", 1, 31, $day).$this->ascList("m", 1, 12, $month).$this->ascList("y", 2000, 2050, $year).
			"<input type=\"hidden\" name=\"$name\" value=\"$val\"/>".
			"<input type=\"hidden\" name=\"_type_$name\" value=\"Date\"/>";
	}
	
	private function ascList($name, $from, $to, $selected) {
		$result = "<select name=\"{$this->id}_$name\">";
		for($i=$from; $i<=$to; $i++) {
			$sel = $i===$selected ? " selected=\"selected\"" : "";
			$result .= "<option$sel>$i</option>";
		}
		return $result."</select>";
	}
	
	public function getValidParents() {
		return array("div", "Form");
	}
	
}
?>