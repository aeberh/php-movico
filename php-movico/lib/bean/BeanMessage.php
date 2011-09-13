<?
class BeanMessage {
	
	const SEVERITY_INFO = "info";
	const SEVERITY_ERROR = "error";
	const SEVERITY_SUCCESS = "success";
	
	private $severity;
	private $message;
	
	public function __construct($severity, $message) {
		$this->severity = $severity;
		$this->message = $message;
	}
	
	public function getMessage() {
		return $this->message;
	}
	
	public function getSeverity() {
		return $this->severity;
	}
	
}
?>