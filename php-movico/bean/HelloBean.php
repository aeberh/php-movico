<?
class HelloBean {
	
	private $name;
	private $message;
	private $pass;
	private $comments;
	
	public function sayHello() {
		$this->message = $this->comments.", ".$this->name."!";
		return "view";
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getMessage() {
		return $this->message;
	}
	
	public function getPass() {
		return $this->pass;
	}
	
	public function setPass($pass) {
		$this->pass = $pass;
	}
	
	public function getComments() {
		return $this->comments;
	}
	
	public function setComments($comments) {
		$this->comments = $comments;
	}
	
}
?>