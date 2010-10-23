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
	if(StringUtil::startsWith($key, "#")) {
		list($beanClass, $nestedProperty) = BeanUtil::getBeanAndProperties($key, true);
		ReflectionUtil::callNestedSetter(BeanLocator::get($beanClass), $nestedProperty, $val);
	}
}

// Handle action
if(isset($_POST["ACTION"])) {
	list($beanClass, $methodName) = BeanUtil::getBeanAndProperties($_POST["ACTION"]);
	$view = ReflectionUtil::callMethod(BeanLocator::get($beanClass), $methodName);
}

$viewXml = "view/$view.xml";

//Parse view
$doc = new SimpleXMLElement($viewXml, null, true);
$parser = new XmlToComponentParser();
$result = $parser->parse($doc);

echo $result->render();

function out($var) {
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}
?>