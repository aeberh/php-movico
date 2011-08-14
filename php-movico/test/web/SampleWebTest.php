<?php
class SampleWebTest extends WebTestCase {
	
	public function testAllItems() {
        $this->check("beans/request/hello", "HelloBean");
        $this->check("beans/session/login", "LoginBean");
        $this->check("beans/application/counter", "CounterBean");
        $this->check("services/onetomany/teams", "One to many relationship");
        $this->check("services/manytomany/classes", "Many to many relationship");
    }
    
    private function check($view, $text) {
    	 $this->get("http://localhost:8888/php-movico/$view");
        $this->assertText($text);
    }
	
}
?>