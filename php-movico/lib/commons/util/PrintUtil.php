<?php
class PrintUtil {

	public static function log($text) {
		echo $text;
	}
	
	public static function logln($text) {
		echo "$text\n";
	}
	
	public static function printTime() {
		echo time()."<br/>";
	}
	
	public static function out($var) {
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}

	public static function outAll() {
		self::out(get_defined_vars());
	}

	public static function outList($array) {
		ArrayUtil::checkTypes($array);
		echo "<ul>";
		foreach($array as $el) {
			StringUtil::checkTypes($el);
			echo "<li>$el</li>";
		}
		echo "</ul>";
	}

}
?>
