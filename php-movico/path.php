<?php
ini_set("display_errors", 1);
ini_set("error_reporting", E_ALL);

$root = dirname(__FILE__);

$directories = array(".", $root);
buildDirectoryList($root, ".", $directories);

ini_set("include_path", implode(PATH_SEPARATOR, $directories));

function __autoload($className) {
	@include_once("$className.php");
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
