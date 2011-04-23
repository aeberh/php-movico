<?
ini_set("display_errors", 1);
ini_set("error_reporting", E_ALL);

$root = dirname(__FILE__);

$directories = array(".", $root);
buildDirectoryList($root, ".", $directories);

ini_set("include_path", implode(PATH_SEPARATOR, $directories));

function __autoload($className) {
	if(in_array(lcfirst($className), array("div", "p", "ul", "ol", "li", "h1", "h2", "h3", "h4", "h5", "h6"))) {
		require_once("HtmlComponent.php");
	} else {
		$found = stream_resolve_include_path("$className.php");
		if ($found !== false) {
			include_once("$className.php");
		}
	}
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
Singleton::create("Settings")->setRootPath($root);
?>
