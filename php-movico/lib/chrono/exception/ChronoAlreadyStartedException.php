<?
class ChronoAlreadyStartedException extends Exception {
	
	public function __construct($time) {
		$this->message = "Chrono was already started $time seconds ago";
	}
	
}
?>