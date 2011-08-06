<?php
include_once("model.php");

class PhotoModel extends Model {

        public function __construct() {
                parent::__construct();
        }

	function deletephoto($param){
		$sql = "DELETE FROM ".TABLE_PREFIX."photo WHERE id = ?";
		$sth = $this->dbh->prepare($sql);
		$sth->execute(array($param['id']));
	}

	function addphoto($param) {
		$sql = "INSERT INTO ".TABLE_PREFIX."photo (name,addtime) VALUES(?,?)";
		$sth = $this->dbh->prepare($sql);
		$sth->execute(array($param['name'],$param['addtime']));
	}
	function editphoto($param) {

		/*
                $dirname = "uploads";
                if (!is_dir($dirname)){
                        mkdir($dirname,0777,true);
                }

                for ($i=0;$i<count($_FILES["file"]["name"]);$i++){
                        $filename = $_FILES["file"]["name"][$i];
                        $upload_file = "$dirname/$filename";

                        if(move_uploaded_file($_FILES["file"]["tmp_name"][$i],$upload_file))
                        {
                                chmod($upload_file,0644);
                        }
                }
		*/
	}

	function getphoto($param) {
		$sql ="SELECT * FROM ".TABLE_PREFIX."photo WHERE id = ?";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['id']));
                return $sth->fetch();
	}

	function getphotobyname($param) {
		$sql ="SELECT * FROM ".TABLE_PREFIX."photo WHERE name = ?";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['name']));
                return $sth->fetch();
	}
	function getallphotos() {
                $sql = "SELECT * FROM ".TABLE_PREFIX."photo";
                $sth = $this->dbh->query($sql);
                return $sth->fetchall();
	}
	function getphotos($param) {
                $num_per_page = isset($param['n']) ? $param['n'] : '1';
                $page = isset($param['p']) ? $param['p'] : '1';
                $start = ($page-1)*$num_per_page;
                $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".TABLE_PREFIX."photo ";
                $sql .= "ORDER BY addtime DESC limit $start,$num_per_page ";
                $sth = $this->dbh->query($sql);
                return $sth->fetchall();
	}

        public function getprevphoto($param) {
                $sql ="SELECT * FROM ".TABLE_PREFIX."photo where id < ? ORDER BY id DESC limit 1";
		$sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['id']));
                return $sth->fetch();
        }
        public function getnextphoto($param) {
                $sql ="SELECT * FROM ".TABLE_PREFIX."photo where id > ? ORDER BY id DESC limit 1";
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
