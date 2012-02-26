<?php
require_once("path.php");
session_start();

require_once("lib/error/runtime-errors.php");

set_exception_handler("handleException");
set_error_handler("handleError", E_ALL^E_NOTICE);

require_once("lib/simpletest/autorun.php");

// String tests
new StringCharAtTest();
new StringCompareTest();
new StringContainsTest();
new StringEndsWithTest();
new StringFromPrimitivesTest();
new StringIndexesOfTest();
new StringIndexOfTest();
new StringLengthTest();
new StringMatchesTest();
new StringRemoveTest();
new StringReplaceTest();
new StringSplitTest();
new StringStartsWithTest();
new StringSubstringTest();

// ArrayList tests
new ListAddElementTest();
new ListGetElementTest();
new ListJoinElementsTest();
new ListContainsTest();
new ListGetSublistTest();
new ListIteratorTest();
new ListSortTest();
new ListToStringTest();
new ListIndexesOfTest();
new ListUpdateElementTest();

// HashSet tests
new SetAddElementTest();

// HashMap tests
new MapPutElementTest();
new MapGetElementTest();
new MapIteratorTest();
new MapToStringTest();

// TypeUtil tests
new IsObjectTypeTest();
new IsPrimitiveTypeTest();
new IsComparableTest();

// Boggle tests
new WordIsPossibleInLayoutTest();
new BoggleGridIndicesTest();

// Xml tests
new XmlTest();
?>