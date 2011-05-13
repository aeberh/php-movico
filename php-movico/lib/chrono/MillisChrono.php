<?
class MillisChrono extends Chrono {
	
	public function __construct() {
		
	}
	
	public function getCurrentTime() {
		return microtime(true)*1000;
	}
	
}
?>