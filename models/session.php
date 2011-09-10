<?php

class SessionModel extends Model {
        function __construct() {
                parent::__construct();
        }

	function addsession($param) {
		$session_id = md5(uniqid(mt_rand(), true));
		if ($param['persistent']){
			setcookie("session_id",$session_id,time()+60*60*24*7,'/');
		} else {
			setcookie("session_id",$session_id,0,'/');
		}
		$sql = "INSERT INTO ".$this->table." (session_id,username) VALUES(?,?)";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($session_id,$param['username']));
		//$result = mysql_query($query,$this->db);
	}

	function deletesession() {
		$session_id = $_COOKIE['session_id'];
		$sql = "DELETE FROM ".$this->table." WHERE session_id = ?";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($session_id));
		//$result = mysql_query($query,$this->db);
		setcookie("session_id","",time()+60*60*24*7);
	}

	function getsession() {
		$session_id = $_COOKIE['session_id'];
		if ($session_id){
			$sql = "SELECT a.username,a.role FROM ".$this->table." s,".TABLE_PREFIX."account a WHERE s.session_id = ? AND s.username = a.username";
			$sth = $this->dbh->prepare($sql);
			$sth->execute(array($session_id));
			return $sth->fetch();

			//$result = mysql_query($query,$this->db);
			//$session=mysql_fetch_assoc($result);
			//return $session;
		}
	}

}
?>
