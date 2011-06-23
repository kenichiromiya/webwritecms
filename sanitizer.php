<?php
$post = array();
$get = array();
foreach ($_POST as $key => $value) {
	if (is_array($value)) {
	// TODO array sanitize
		$post[$key] = $value;
	} else {
		$post[$key] = strip_tags($value);
	}
}
foreach ($_GET as $key => $value) {
	if (is_array($value)) {
		$get[$key] = $value;
	} else {
		$get[$key] = strip_tags($value);
	}
}
$param = array_merge($post,$get);
if ($param['_method']) {
	$method = strtoupper($param['_method']);
} else {
	$method = $_SERVER["REQUEST_METHOD"];
}
$param['method'] = $method;
/*
extract($post);
extract($get);
foreach ($_REQUEST as $key => $value) {
	if (is_array($value)) {
		$req[$key] = $value;
	} else {
		$req[$key] = strip_tags($value);
	}
}
*/
?>
