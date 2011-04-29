<?
class CountdownTimer extends Component {

	private $millis;
	private $action;
	
	public function setMillis($millis) {
		$this->millis = $millis;
	}
	
	public function setAction($action) {
		$this->action = $action;
	}
	
	public function doRender($row=null) {
		return "<div class=\"movico-timer\">".
			"<span></span>".
			"<input type=\"hidden\" name=\"".$this->millis."\" value=\"".$this->getConvertedValue($this->millis)."\"/>".
			"<button onclick=\"this.form.ACTION.value='".$this->action."';\"></button>".
			"</div>";
	}
	
	public function getValidParents() {
		return array("div", "Form");
	}

}
?>