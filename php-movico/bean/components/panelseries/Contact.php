<?
class Contact {
	
	private $name;
	private $job;
	
	public function __construct($name, $job) {
		$this->name = $name;
		$this->job = $job;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getJob() {
		return $this->job;
	}
	
}
?>