<?
require_once("path.php");
session_start();

require_once("lib/error/runtime-errors.php");

set_exception_handler("handleException");
set_error_handler("handleError", E_ALL^E_NOTICE);

require_once("lib/simpletest/autorun.php");

// String tests
new StringContainsTest();
new StringStartsWithTest();
new StringEndsWithTest();
new StringLengthTest();
new StringSplitTest();
new StringMatchesTest();

// ArrayList tests
new ListAddElementTest();
new ListGetElementTest();
?>