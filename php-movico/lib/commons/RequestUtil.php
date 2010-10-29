<? 
class RequestUtil {
	
	public static function get($key, $defaultValue=null) {
		if(isset($_POST[$key])) {
			return $_POST[$key];
		}
		return $defaultValue;
	}
	
}
?>