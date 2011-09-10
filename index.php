<?php
function __autoload($class_name) {
	preg_match_all("/[A-Z][a-z0-9]+/",$class_name,$m);
	$file_name = "";
	if (isset($m[0][1])) {
		$file_name = strtolower($m[0][1])."s/";
	}
	$file_name = $file_name.strtolower($m[0][0]).".php";
	include $file_name;
}

include_once("define.php");
include_once("db.php");
include_once("lang.php");
include_once("helper.php");

//$sanitizer = New Sanitizer();
//$param = $sanitizer->sanitize();
$dispatcher = New Dispatcher();
$dispatcher->dispatch();
?>
