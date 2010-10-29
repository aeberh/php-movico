<?
require_once("path.php");
require_once("lib/error/runtime-errors.php");

$view = Singleton::create("ActionController")->perform($_POST);
print Singleton::create("ViewRenderer")->render($view);
?>