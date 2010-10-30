<?php
class StringUtil {

	public static function checkTypes() {
		foreach (func_get_args() as $arg) {
			if(!is_string($arg)) {
				throw new InvalidTypeException("Expected type 'string' but was '".gettype($arg)."'");
			}
		}
	}

	public static function contains($haystack, $needle, $caseSensitive=false) {
		self::checkTypes($haystack, $needle);
		if($caseSensitive)
			return strpos($haystack, $needle) !== false;
		return strpos(strtolower($haystack), strtolower($needle)) !== false;
	}
	
	public static function startsWith($string, $start, $caseSensitive=false) {
		self::checkTypes($string, $start);
		if(!$caseSensitive) {
			$string = strtolower($string);
			$start = strtolower($start);
		}
		return strpos($string, $start) === 0;
	}

    public static function endsWith($string, $end, $caseSensitive=false) {
		self::checkTypes($string, $end);
		if(!$caseSensitive) {
			$string = strtolower($string);
			$end = strtolower($end);
		}
		return substr($string, strlen($string)-strlen($end), strlen($end)) == $end;
	}
	
	public static function split($string, $delimiter) {
		self::checkTypes($string, $delimiter);
		return explode($delimiter, $string);
	}
	
	public static function combine($parts, $delimiter) {
		ArrayUtil::checkTypes($parts);
		self::checkTypes($delimiter);
		return implode($delimiter, $parts);
	}

    public static function hasExtension($fileName, $extension) {
		self::checkTypes($fileName, $extension);
		return self::endsWith($fileName, ".".$extension);
    }

	public static function stripExtension($fileName) {
		self::checkTypes($fileName);
		return substr($fileName, 0, strrpos($fileName, "."));
	}

	public static function stripPathAndExtension($fileName) {
		self::checkTypes($fileName);
		return self::stripExtension(substr($fileName, strrpos($fileName, "/")+1));
	}

	public static function replaceWith($string, $old, $new) {
		self::checkTypes($string, $old, $new);
		return str_replace($old, $new, $string);
	}
	
	public static function replaceAssoc($string, $replaceMap) {
		self::checkTypes($string);
		$result = $string;
		foreach($replaceMap as $key=>$value) {
			$result = self::replaceWith($result, $key, $value);
		}
		return $result;
	}

	public static function untill($input, $needle) {
		self::checkTypes($input, $needle);
		return strstr($input, $needle, true);
	}

	public static function remove($input, $needle) {
		return self::replaceWith($input, $needle, "");
	}
	
	public static function getter($key) {
		self::checkTypes($key);
		return "get".ucfirst($key);
	}
	
	public static function boolGetter($key) {
		self::checkTypes($key);
		return "is".ucfirst($key);
	}
	
	public static function setter($key) {
		self::checkTypes($key);
		return "set".ucfirst($key);
	}

	public static function lowercaseFirst($string) {
		self::checkTypes($string);
		return strtolower($string[0]).substr($string, 1);
	}
	
	public static function getJson($key, $value) {
		self::checkTypes($key, $value);
		return json_encode(array($key=>$value));
	}
	
}
?>
