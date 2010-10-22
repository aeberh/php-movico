<?php
$localPath = "/var/www/phpfaces";
$root = @file_exists($localPath) ? $localPath : dirname(__FILE__);

$directories = array(".", $root);
buildDirectoryList($root, ".", $directories);

ini_set("include_path", implode(PATH_SEPARATOR, $directories));

function __autoload($className) {
	require_once($className.".php");
}

set_exception_handler("handleException");
function handleException($e) {
	require_once("lib/error/exception.php");
}

set_error_handler("handleError", E_ALL);
function handleError($type, $msg, $file, $line, $context) {
	require_once("lib/error/error.php");
}

function buildDirectoryList($absRoot, $root, &$paths) {
	$dirs = scandir($root);
	foreach($dirs as $dir) {
		$absDir = $root."/".$dir;
		if(!in_array($dir, array(".", "..")) && is_dir($absDir)) {
			$paths[] = $absRoot."/".$absDir;
			buildDirectoryList($absRoot, $absDir, $paths);
		}
	}
}
?>
