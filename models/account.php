<?php
include_once("models/cms.php");

class AccountModel extends CMSModel {

	public function __construct(){
		parent::__construct();
	}

	function deleteaccount($param){
		$query = sprintf("DELETE FROM %s WHERE username = '%s'",TABLE_PREFIX."account",m($param['username']));
		mysql_query($query,$this->db);
	}

	function addaccount($param) {
		$password = md5($param['password']);
		$query = sprintf("INSERT INTO %s (username,password,email,role)
				VALUES('%s','%s','%s','%s')",TABLE_PREFIX."account",m($param['username']),m($password),m($param['email']),m($param['role']));
		mysql_query($query,$this->db);
	}
	function editaccount($param) {
		$password = md5($param['password']);
		$query = sprintf("UPDATE %s SET  password = '%s',email = '%s',role = '%s'  WHERE username = '%s'",TABLE_PREFIX."account",m($password),m($param['email']),m($param['role']),m($param['username']));
		mysql_query($query,$this->db);
	}
	function getaccount($param) {
		$query = sprintf("SELECT * FROM %s WHERE username = '%s'",TABLE_PREFIX."account",m($param['username']));
		$result = mysql_query($query,$this->db);
		$account=mysql_fetch_assoc($result);
		return $account;
	}

	function authaccount($param) {
		$password = md5($param['password']);
		$query = sprintf("SELECT * FROM %s
				WHERE username = '%s' and password = '%s'",TABLE_PREFIX."account",m($param['username']),m($password));
		$result = mysql_query($query,$this->db);
		$num = mysql_num_rows($result);
		if ($num) {
			return true;
		} else {
			return false;
		}
	}

	function getaccounts() {
		$query = sprintf("SELECT * FROM %s",TABLE_PREFIX."account");
		$result = mysql_query($query,$this->db);
		$accounts = array();
		while ($account=mysql_fetch_assoc($result)){
			array_push($accounts,$account);
		}
		return $accounts;
	}
}
?>
