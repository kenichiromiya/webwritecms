<?php

class AccountModel extends Model {

	public function __construct(){
		parent::__construct();
	}

	function addaccount($param) {
		$password = md5($param['password']);
		$sql = "INSERT INTO ".$this->table." (username,password,email,role) VALUES(?,?,?,?)";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['username'],$password,$param['email'],$param['role']));
		//mysql_query($query,$this->db);
	}
	function editaccount($param) {
		$password = md5($param['password']);
		$sql = "UPDATE ".$this->table." SET  password = ?,email = ?,role = ?  WHERE username = ?";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($password,$param['email'],$param['role'],$param['username']));
		//mysql_query($query,$this->db);
	}
	function deleteaccount($param){
		$sql = "DELETE FROM ".$this->table." WHERE username = ?";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['username']));
		//mysql_query($query,$this->db);
	}

	function getaccount($param) {
		$sql = "SELECT * FROM ".$this->table." WHERE username = ?";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['username']));
                return $sth->fetch();

	}

	function authaccount($param) {
		$password = md5($param['password']);
		$sql = "SELECT count(*) as accountnum FROM ".$this->table." WHERE username = ? and password = ?";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['username'],$password));
                $row = $sth->fetch();
		if ($row['accountnum']) {
			return true;
		} else {
			return false;
		}
	}

	function getaccounts() {
		$sql = "SELECT * FROM ".$this->table;
		$sth = $this->dbh->query($sql);
		return $sth->fetchAll();

	}
}
?>
