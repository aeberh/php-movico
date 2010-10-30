<?
function handleException($e) {
	$result = ExceptionPrinter::printException($e);
	if(isset($_GET["jquery"])) {
		$result = StringUtil::getJson("body", $result);
	}
	print $result;
}

function handleError($type, $msg, $file, $line, $context) {
	$result = ErrorPrinter::printError($type, $msg, $file, $line, $context);
	if(isset($_GET["jquery"])) {
		$result = StringUtil::getJson("body", $result);
	}
	print $result;
}
?>