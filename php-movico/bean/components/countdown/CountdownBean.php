<?
class CountdownBean extends RequestBean {
	
	private $millis;
	private $msg;
	
	public function __construct() {
		$this->millis = 3000;
	}
	
	public function getMillis() {
		return $this->millis;
	}
	
	public function setMillis($millis) {
		$this->millis = $millis;
	}
	
	public function getMsg() {
		return $this->msg;
	}
	
	public function timesUp() {
		$this->msg = "Time's up!";
		return null;
	}

}
?>