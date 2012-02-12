<?php
class StringMatchesTest extends UnitTestCase {
	
	private $input;
	
	public function __construct() {
		$this->input = new String("Test <a> Blaat <b>");
	}
	
	function testMatches() {
		$input = new String("<b>bold</b> <i>italic</i>");
		$pattern = "|<[^>]+>(.*)</[^>]+>|U";
		$matches = $input->getMatches($pattern);
		
		$this->assertEqual(2, $matches->size());
		$this->assertEqual(2, $matches->get(0)->size());
		$this->assertEqual(new String("<b>bold</b>"), $matches->get(0)->get(0));
		$this->assertEqual(new String("bold"), $matches->get(0)->get(1));
		$this->assertEqual(2, $matches->get(1)->size());
		$this->assertEqual(new String("<i>italic</i>"), $matches->get(1)->get(0));
		$this->assertEqual(new String("italic"), $matches->get(1)->get(1));
	}
	
	function testNoMatch() {
		$input = new String("blaat");
		$pattern = "|<[^>]+>(.*)</[^>]+>|U";
		$matches = $input->getMatches($pattern);
		
		$this->assertEqual(0, $matches->size());
	}
	
}
?>