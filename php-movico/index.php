<?
require_once("path.php");

session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$view = View::DEFAULT_VIEW;

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
	$beanInstance = BeanLocator::get($beanClass);
	if(isset($_POST[DataTable::DATATABLE_ROW])) {
		$rowIndex = $_POST[DataTable::DATATABLE_ROW];
		ReflectionUtil::callNestedSetter($beanInstance, "selectedRowIndex", $rowIndex);
	}
	$view = ReflectionUtil::callMethod($beanInstance, $methodName);
	if(is_null($view)) {
		$view = $_POST["VIEW"];
	}
}

$viewXml = "view/$view.xml";
if(!file_exists($viewXml)) {
	throw new ViewNotExistsException($view);
}

//Parse view
$doc = new SimpleXMLElement($viewXml, null, true);
$parser = new XmlToComponentParser();
$viewRoot = $parser->parse($doc);

$viewRoot->setPage($view);

if(isset($_GET["jquery"])) {
	echo json_encode(array("body"=>$viewRoot->renderBodyChildren()));
} else {
	echo $viewRoot->render();
}
?>