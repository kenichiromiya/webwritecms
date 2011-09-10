<?php
$_DB = mysql_connect(MYSQL_CONNECT_HOST,MYSQL_CONNECT_USER,MYSQL_CONNECT_PASS) or die("cannnot connect");
mysql_select_db(MYSQL_DB_NAME,$_DB);
$query = "SET NAMES utf8";

mysql_query($query,$_DB);

class DB
{
	static $dbh;
	function connect() {
		if (isset($this->dbh)){
			return $this->dbh;
		}	
		$dbh = new PDO('mysql:host='.MYSQL_CONNECT_HOST.';dbname='.MYSQL_DB_NAME, MYSQL_CONNECT_USER, MYSQL_CONNECT_PASS);
		$query = "SET NAMES utf8";
		$dbh->query($query);
		$this->dbh = $dbh;
		return $this->dbh;
	}
}

?>
