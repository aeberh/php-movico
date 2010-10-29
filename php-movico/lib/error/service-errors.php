<?
set_exception_handler("handleException");
function handleException($e) {
	PrintUtil::logln("[EXCEPTION] "+$e->getMessage());
}

set_error_handler("handleError", E_ALL);
function handleError($type, $msg, $file, $line, $context) {
	PrintUtil::logln("[$type] $msg ($file:$line)");
}
?>