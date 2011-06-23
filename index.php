<?php
include_once("define.php");
include_once("db.php");
include_once("lang.php");
include_once("helper.php");
include_once("sanitizer.php");
include_once("dispatcher.php");
include_once("template.php");
include_once("controller.php");

$dispatcher = New Dispatcher();
$dispatcher->dispatch();
?>
