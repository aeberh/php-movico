<?php
class HelloBean extends RequestBean {
        
    private $name;
    private $message;

    public function sayHello() {
        $this->message = "Hello, ".$this->name;
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