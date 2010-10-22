<?php
class HelloBean extends RequestBean {
        
    private $name;
    private $names = array("Peter"=>"Peter", "Sandra"=>"Sandra");
    private $message;

    public function sayHello() {
        $this->message = "Hello, ".$this->name."!";
        return "view1";
    }
    
    public function goBack() {
    	return "view1";
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
    
    public function getNames() {
    	return $this->names;
    }
        
}
?>