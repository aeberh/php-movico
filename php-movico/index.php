<?
require_once("path.php");
session_start();

require_once("lib/error/runtime-errors.php");

set_exception_handler("handleException");
set_error_handler("handleError", E_ALL);

/*
$view = Singleton::create("ActionController")->perform($_POST, $_FILES);
print Singleton::create("ViewRenderer")->render($view);
*/

$string = new String("Peter Mesotten");
echo "<br/>Contains Pet: ".new Boolean($string->contains("Pet"));
echo "<br/>Starts with Pet: ".new Boolean($string->startsWith("Peter"));
echo "<br/>Ends with ten: ".new Boolean($string->endsWith("ten"));
echo "<br/>Ends with Pet: ".new Boolean($string->endsWith("Pet"));
?>