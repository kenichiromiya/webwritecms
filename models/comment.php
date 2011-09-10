<?php

class CommentModel extends Model {

	public $commentnums;

	function __construct() {
		parent::__construct();
	}

	function addcomment($param) {
		$sql = "INSERT INTO ".$this->table." (entry_id,name,url,title,body,adddate) VALUES(?,?,?,?,?,now())";
                $sth = $this->dbh->prepare($sql);
                //echo $param['id']."#".$param['name']."#".$param['url']."#".$param['title']."#".$param['body'];
                $sth->execute(array($param['id'],$param['name'],$param['url'],$param['title'],$param['body']));
                //$sth->execute(array("16","hage","",$param['title'],$param['body']));
		//mysql_query($query,$this->db);

	}

	function getcomments($param) {
		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table." WHERE entry_id = ? ORDER BY adddate";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['id']));
                return $sth->fetchAll();
	}

	function getcommentnum($id) {
		$sql = "SELECT count(*) AS commentnum FROM ".$this->table." WHERE entry_id = ?";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($id));
                //return $sth->fetchAll();
                $row = $sth->fetch();
                return $row['commentnum'];
	}
}
?>
