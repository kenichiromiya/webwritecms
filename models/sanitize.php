<?php
/*
foreach ($_REQUEST as $key => $value) {
	$_REQUEST[$key] = strip_tags($value,ALLOWABLE_TAGS);
}
*/
function s($str,$allowable_tags = "") {
	return strip_tags($str,$allowable_tags);
}
foreach ($_POST as $key => $value) {
//	$_POST[$key] = strip_tags($value,ALLOWABLE_TAGS);
	$_POST[$key] = stripslashes($value);
}
foreach ($_GET as $key => $value) {
//	$_GET[$key] = strip_tags($value,ALLOWABLE_TAGS);
	$_GET[$key] = stripslashes($value);
}
?>
