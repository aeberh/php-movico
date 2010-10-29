<?php
error_reporting(E_ALL);
ini_set("display_errors", "1");

require_once("path.php");
require_once("lib/error/service-errors.php");

print "\n\n";
$sb = Singleton::create("ServiceBuilder");
$entities = $sb->buildServices();
print "\n\n";
?>