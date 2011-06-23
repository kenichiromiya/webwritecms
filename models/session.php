<?php
include_once("models/cms.php");

class SessionModel extends CMSModel {
        function __construct() {
                parent::__construct();
        }

	function getsession() {
		$session_id = $_COOKIE['session_id'];
		if ($session_id){
			$query = sprintf("SELECT a.username,a.role FROM %s s,%s a WHERE s.session_id = '%s' AND s.username = a.username",TABLE_PREFIX."session",TABLE_PREFIX."account",m($session_id));
			$result = mysql_query($query,$this->db);
			$session=mysql_fetch_assoc($result);
			return $session;
		}
	}

	function deletesession() {
		$session_id = $_COOKIE['session_id'];
		$query = sprintf("DELETE FROM %s WHERE session_id = '$session_id'",TABLE_PREFIX."session");
		$result = mysql_query($query,$this->db);
		setcookie("session_id","",time()+60*60*24*7);
	}

	function addsession($param) {
		$session_id = md5(uniqid(mt_rand(), true));
		if ($param['persistent']){
			setcookie("session_id",$session_id,time()+60*60*24*7,'/');
		} else {
			setcookie("session_id",$session_id,0,'/');
		}
		$query = sprintf("INSERT INTO %s (session_id,username) VALUES('%s','%s')",TABLE_PREFIX."session",m($session_id),m($param['username']));
		$result = mysql_query($query,$this->db);
	}
}
?>
