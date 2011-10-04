<?php
class ExceptionPrinter {
	
	public static function printException(Exception $e) {
		$className = get_class($e);
		$trace = self::printTrace($e);
		$msg = $e->getMessage();
		$msg = empty($msg) ? "" : ": $msg!";
		return <<<ERR
		<style type="text/css">
			#errors {
				border: 1px solid red;
				background: #FFD9D9;
				padding: 15px;
				font: 12px Tahoma;	
				color: gray;			
			}
			
			#message {
				color: red;
				font-weight: bold;
			}
		</style>
		<div id="errors">
			<span id="message"><u>$className</u>$msg</span>
			$trace
		</div>
ERR;
	}
	
	private static function getClassName(Exception $e) {
		return get_class($e);
	}
	
	private static function printTrace($exception) {
		$trace = $exception->getTrace();
		$result = "<ol>";
		foreach($trace as $step) {
			$result.="<li>".self::printStep($step)."</li>";
		}
		return $result."</ol>";
	}
	
	private static function printStep($step) {
		$result = "<b>".$step["function"]."</b>(".self::createParameterList($step["args"]).")</b> in ";
		if(empty($step["file"])) {
			return $result."<b>".$step["class"]."</b>.";
		} else {
			return $result."<b>".self::stripPathAndExtension($step["file"])."</b> on line <b>".$step["line"]."</b>.";
		}
	}
	
	private static function createParameterList($argList) {
		$args = array();
		foreach($argList as $arg) {
			$el = $arg;
			if(is_string($arg)) {
				$el = "\"$arg\"";
			}
			if(is_object($arg)) {
				$el = "&lt;".get_class($arg)."&gt;";
			}
			if(is_array($arg)) {
				if(empty($arg)) {
					$type = "";
				} else {
					$firstEl = current($arg);
					$type = gettype($firstEl);
					if("object" == $type) {
						$type = get_class($firstEl);
					}
				}
				$el = $type."[]";
			}
			$args[] = $el;
		}
		return implode(", ", $args);
	}
	
	private static function stripExtension($fileName) {
		return substr($fileName, 0, strrpos($fileName, "."));
	}
	
	private static function stripPathAndExtension($fileName) {
		return self::stripExtension(substr($fileName, strrpos($fileName, "/")+1));
	}
	
}
?>