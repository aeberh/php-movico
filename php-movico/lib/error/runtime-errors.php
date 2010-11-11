<?
function handleException($e) {
	$result = ExceptionPrinter::printException($e);
	if(isset($_GET["jquery"])) {
		$result = StringUtil::getJson("body", $result);
	}
	print $result;
	die();
}

function handleError($type, $msg, $file, $line, $context) {
	if(error_reporting() === 0) {
		return false;
	}
	$result = ErrorPrinter::printError($type, $msg, $file, $line, $context);
	if(isset($_GET["jquery"])) {
		$result = StringUtil::getJson("body", $result);
	}
	print $result;
}
?>