<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$localPath = "/var/www/phpfaces";
$root = @file_exists($localPath) ? $localPath : dirname(__FILE__);

$directories = array(".", $root);
buildDirectoryList($root, ".", $directories);

ini_set("include_path", implode(PATH_SEPARATOR, $directories));

function __autoload($className) {
	require_once($className.".php");
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
