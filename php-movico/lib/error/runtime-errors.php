<?
set_exception_handler("handleException");
function handleException($e) {
	require_once("lib/error/exception.php");
}

set_error_handler("handleError", E_ALL);
function handleError($type, $msg, $file, $line, $context) {
	require_once("lib/error/error.php");
}
?>