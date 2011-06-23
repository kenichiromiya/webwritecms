<?php
function getprev($id) {
	global $_DB;
	$sql = "SELECT * FROM entry where id < '$id' ORDER BY id DESC limit 1";
	$result = mysql_query($sql,$_DB);
	$entry=mysql_fetch_assoc($result);
	return $entry;
}
function getnext($id) {
	global $_DB;
	$sql = "SELECT * FROM entry where id > '$id' ORDER BY id limit 1";
	$result = mysql_query($sql,$_DB);
	$entry=mysql_fetch_assoc($result);
	return $entry;
}
?>
