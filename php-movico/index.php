<?
require_once("path.php");

session_start();


ini_set('display_errors', 1);
error_reporting(E_ALL);

$view = "view1";

// Validate
//TODO

// Update model
foreach($_POST as $key=>$val) {
	if(strpos($key, "_") !== false) {
		BeanUtil::setProperty($key, $val);
	}
}

// Handle action
if(isset($_POST["ACTION"])) {
	$view = BeanUtil::execute($_POST["ACTION"]);
}

$viewXml = "view/$view.xml";

//Parse view
$doc = new SimpleXMLElement($viewXml, null, true);
$parser = new XmlToComponentParser();
$result = $parser->parse($doc);

echo $result->render();

out($_SESSION);

function out($var) {
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}
?>