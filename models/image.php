<?php
include_once("models/cms.php");

class ImageModel extends CMSModel {

        public function __construct() {
                parent::__construct();
        }

	function deleteimage($param){
		$query = sprintf("DELETE FROM %s WHERE username = '%s'",TABLE_PREFIX."image",m($param['username']));
		mysql_query($query,$this->db);
	}

	function addimage($param) {
		$password = md5($param['password']);
		$query = sprintf("INSERT INTO %s (username,password,email,role)
				VALUES('%s','%s','%s','%s')",TABLE_PREFIX."image",m($param['username']),m($password),m($param['email']),m($param['role']));
		mysql_query($query,$this->db);
	}
	function editimage($param) {

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
		if ($_FILES["file"]["name"]) {
			$dirname = "uploads";
			if (!is_dir($dirname)){
				mkdir($dirname,0777,true);
			}
			$filename = $_FILES["file"]["name"];
			$upload_file = "$dirname/$filename";

			if(move_uploaded_file($_FILES["file"]["tmp_name"],$upload_file))
			{
				chmod($upload_file,0644);
			}
			$query = sprintf("INSERT INTO %s (filename) VALUES('%s')",TABLE_PREFIX."image",m($upload_file));
			//	$query = sprintf("UPDATE %s SET filename = '%s',moddate = now()  WHERE id=1",TABLE_PREFIX."image",m($param['title']),m($upload_file),m($param['copyright']));
		}
		mysql_query($query,$this->db);
	}

	function getimage() {
		$query = sprintf("SELECT * FROM %s",TABLE_PREFIX."image");
		$result = mysql_query($query,$this->db);
		$account=mysql_fetch_assoc($result);
		return $account;
	}
}
?>
