<?
function handleException($e) {
	PrintUtil::logln("[EXCEPTION] ".$e->getMessage()."\n\n");
}

function handleError($type, $msg, $file, $line, $context) {
	PrintUtil::logln("[$type] $msg ($file:$line)\n\n");
}
?>