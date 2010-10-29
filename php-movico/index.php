<?
require_once("path.php");

$view = Singleton::create("ActionController")->perform($_POST);
print Singleton::create("ViewRenderer")->render($view);
?>