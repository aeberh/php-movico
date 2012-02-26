<?php
function handleException($e) {
	echo ExceptionPrinter::printException($e);
}

function handleError($type, $msg, $file, $line, $context) {
	echo ErrorPrinter::printError($type, $msg, $file, $line, $context);
}
?>