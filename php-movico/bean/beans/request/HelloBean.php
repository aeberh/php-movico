<?php
class HelloBean extends RequestBean {
        
	const GREETING = "Hello";
	
    private $name;
    private $message;

    public function sayHello() {
        $this->message = self::GREETING.", ".$this->name."!";
        return null;
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
    
}
?>