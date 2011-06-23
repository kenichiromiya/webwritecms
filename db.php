<?php
$_DB = mysql_connect(MYSQL_CONNECT_HOST,
MYSQL_CONNECT_USER,MYSQL_CONNECT_PASS) or die("cannnot connect");
mysql_select_db(MYSQL_DB_NAME,$_DB);
$query = "SET NAMES utf8";
mysql_query($query,$_DB);
?>
