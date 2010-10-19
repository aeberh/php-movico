<?
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/BeanLocator.php");
require_once("util/ComponentNotExistsException.php");
require_once("util/InvalidComponentHierarchyException.php");
require_once("util/XmlToComponentParser.php");
require_once("util/BeanUtil.php");
require_once("bean/HelloBean.php");
require_once("components/Component.php");
require_once("components/View.php");
require_once("components/Form.php");
require_once("components/AbstractInput.php");
require_once("components/OutputText.php");
require_once("components/InputText.php");
require_once("components/InputTextArea.php");
require_once("components/PanelGrid.php");
require_once("components/OutputLabel.php");
require_once("components/InputSecret.php");
require_once("components/CommandButton.php");
require_once("components/HtmlComponent.php");

$view = "view";

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

function out($var) {
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}
?>