<?php

class UploadModel extends Model {

        public function __construct() {
                parent::__construct();
        }

/*
        function addupload($param) {
                $sql = "INSERT INTO ".$this->table." (name,addtime) VALUES(?,?)";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['name'],$param['addtime']));
        }

	function editupload($param) {

	}
*/
	function getuploadbyfilename($param) {
		$sql ="SELECT * FROM ".$this->table." WHERE filename = ?";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['filename']));
                return $sth->fetch();
	}
	function getalluploads() {
                $sql = "SELECT * FROM ".$this->table."";
                $sth = $this->dbh->query($sql);
                return $sth->fetchall();
	}
	function getlastupload() {
                $sql = "SELECT * FROM ".$this->table." ORDER BY addtime DESC limit 1";
                $sth = $this->dbh->query($sql);
                return $sth->fetch();
	}
	function getuploads($param) {
                $num_per_page = isset($param['n']) ? $param['n'] : '1';
                $page = isset($param['p']) ? $param['p'] : '1';
                $start = ($page-1)*$num_per_page;
                $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table." ";
                $sql .= "ORDER BY addtime DESC limit $start,$num_per_page ";
                $sth = $this->dbh->query($sql);
                return $sth->fetchall();
	}

        public function getprevupload($param) {
                $sql ="SELECT * FROM ".$this->table." where id < ? ORDER BY id DESC limit 1";
		$sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['id']));
                return $sth->fetch();
        }
        public function getnextupload($param) {
                $sql ="SELECT * FROM ".$this->table." where id > ? ORDER BY id ASC limit 1";
		$sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['id']));
                return $sth->fetch();
        }

        public function getcount() {
                $sql = "SELECT FOUND_ROWS()";
                $sth = $this->dbh->query($sql);
                $row = $sth->fetch();
		return $row['FOUND_ROWS()'];
                //$sth = mysql_query($sql,$this->db);
                //$count = mysql_sth($sth,0);
                //return $count;
        }
}
?>
