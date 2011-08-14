<?
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
		if(is_file($absDir) && strpos($dir, ".php") == strlen($dir)-4 && substr(ucfirst($dir), 0, 1) === substr($dir, 0, 1)) {
			$classes[] = substr($dir, 0, strlen($dir)-4);
		}
		if(!in_array($dir, array(".", "..")) && is_dir($absDir)) {
			$paths[] = $absRoot."/".$absDir;
			buildDirectoryList($absRoot, $absDir, $paths, $classes);
		}
	}
}
Singleton::create("Settings")->setRootPath($root);
setlocale(LC_ALL, Singleton::create("Settings")->getLocale());
?>
