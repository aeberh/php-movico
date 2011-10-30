<?php
ini_set("display_errors", 1);
ini_set("error_reporting", E_ALL);

$root = dirname(__FILE__);

$directories = array(".", $root);
$classes = array();
buildDirectoryList($root, ".", $directories, $classes);

ini_set("include_path", implode(PATH_SEPARATOR, $directories));

ClassCache::init($classes);

function __autoload($className) {
	if(in_array(lcfirst($className), array("div", "p", "span", "ul", "ol", "li", "h1", "h2", "h3", "h4", "h5", "h6"))) {
		require_once("HtmlComponent.php");
	} else {
		$found = stream_resolve_include_path("$className.php");
		if($found === false) {
			$className = strtolower($className);
			$found = stream_resolve_include_path("$className.php");
		}
		if ($found !== false) {
			include_once("$className.php");
		}
	}
}

function buildDirectoryList($absRoot, $root, &$paths, &$classes) {
	$dirs = scandir($root);
	foreach($dirs as $dir) {
		$absDir = $root."/".$dir;
		$endOfClassName = strpos($dir, ".php");
		if(is_file($absDir) && $endOfClassName !== -1 && ucfirst($dir) === $dir) {
			$classes[] = substr($dir, 0, $endOfClassName);
		}
		if($dir != "." && $dir != ".." && is_dir($absDir)) {
			$paths[] = $absRoot."/".$absDir;
			buildDirectoryList($absRoot, $absDir, $paths, $classes);
		}
	}
}
$settings = Singleton::create("Settings");
$settings->setRootPath($root);
setlocale(LC_ALL, $settings->getLocale());
date_default_timezone_set($settings->getTimeZone());
?>
