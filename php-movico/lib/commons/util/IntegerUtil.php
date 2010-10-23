<?php
class IntegerUtil {

	private static function checkTypes() {
		foreach (func_get_args() as $arg) {
			if(!is_int($arg)) {
				throw new InvalidTypeException("Expected type 'integer' but was '".gettype($arg)."'");
			}
		}
	}

}
?>
