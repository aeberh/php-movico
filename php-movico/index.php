<?
require_once("path.php");
session_start();

require_once("lib/error/runtime-errors.php");

set_exception_handler("handleException");
set_error_handler("handleError", E_ALL);

$view = Singleton::create("ActionController")->perform($_POST, $_FILES);
print Singleton::create("ViewRenderer")->render($view);
?>