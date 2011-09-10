<?php

class TemplateModel extends Model {

	public function __construct(){
		parent::__construct();
	}

        function gettemplatebyfilename($param) {
                $sql ="SELECT * FROM ".$this->table." WHERE filename = ?";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['filename']));
                return $sth->fetch();
        }

	function authtemplate($param) {
		$password = md5($param['password']);
		$sql = "SELECT count(*) as templatenum FROM ".$this->table." WHERE username = ? and password = ?";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['username'],$password));
                $row = $sth->fetch();
		if ($row['templatenum']) {
			return true;
		} else {
			return false;
		}
	}

	function gettemplates() {
		$sql = "SELECT * FROM ".$this->table." ORDER BY filename";
		$sth = $this->dbh->query($sql);
		return $sth->fetchAll();

		/*
		$result = mysql_query($query,$this->db);
		$templates = array();
		while ($template=mysql_fetch_assoc($result)){
			array_push($templates,$template);
		}
		return $templates;
		*/
	}
}
?>
