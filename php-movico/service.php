<?php
error_reporting(E_ALL);
ini_set("display_errors", "1");

require_once("path.php");

$sb = Singleton::create("ServiceBuilder");
$entities = $sb->buildServices();
?>
