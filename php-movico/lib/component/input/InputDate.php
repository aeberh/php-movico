<?php
class InputDate extends Component {
	
	const DATE_TRANSFER_FORMAT = "%d-%m-%Y %H:%M";
	
	private $value;
	private $showTime;
	private $yearStart;
	private $yearEnd;
	private $minutesInterval;
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setShowTime($showTime) {
		$this->showTime = $showTime;
	}
	
	public function setYearStart($yearStart) {
		$this->yearStart = $yearStart;
	}
	
	public function setYearEnd($yearEnd) {
		$this->yearEnd = $yearEnd;
	}
	
	public function setMinutesInterval($minutesInterval) {
		$this->minutesInterval = $minutesInterval;
	}
	
	public function doRender($index=null) {
		$name = $this->value;
		$dateObj = $this->getConvertedValue($name, $index);
		if(empty($dateObj)) {
			$dateObj = Date::createNow();
		}
		$val = $dateObj->format(self::DATE_TRANSFER_FORMAT);
		$result = $this->datePicker($dateObj);
		if($this->showTime) {
			$result .= $this->timePicker($dateObj);
		}
		return "<input type=\"hidden\" name=\"$name\" value=\"$val\"/>".
			"<input type=\"hidden\" name=\"_type_$name\" value=\"Date\"/>".$result;
	}
	
	private function timePicker(Date $dateObj) {
		$mInt = empty($this->minutesInterval) ? 1 : intval($this->minutesInterval);
		return $this->ascList("h", 0, 23, $dateObj->getHour()).
			$this->ascList("mn", 0, 59, $dateObj->getMinutes(), $mInt);
	}
	
	private function datePicker(Date $dateObj) {
		$yStart = empty($this->yearStart) ? "-3" : $this->yearStart;
		$yEnd = empty($this->yearEnd) ? "+3" : $this->yearEnd;
		return $this->ascList("d", 1, 31, $dateObj->getDay()).
			$this->ascList("m", 1, 12, $dateObj->getMonth()).
			$this->ascList("y", $this->getEvaledYear($yStart), $this->getEvaledYear($yEnd), $dateObj->getYear());
	}
	
	private function getEvaledYear($strEval) {
		eval("\$result = ".Date::createNow()->getYear().$strEval.";");
		return $result;
	}
	
	private function ascList($name, $from, $to, $selected, $interval=1) {
		$result = "<select name=\"{$this->id}_$name\">";
		for($i=$from; $i<=$to; $i++) {
			if($i % $interval == 0) {
				$sel = $i===$selected ? " selected=\"selected\"" : "";
				$result .= "<option$sel value=\"$i\">".$this->getLabel($i)."</option>";
			}
		}
		return $result."</select>";
	}
	
	private function getLabel($i) {
		return $i<10 ? "0$i" : $i;
	}
	
	public function getValidParents() {
		return array("div", "Form");
	}
	
}
?>