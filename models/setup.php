<?php
include_once("model.php");

class SetupModel extends Model {
	public $error;

	public function __construct(){
		parent::__construct();
		$this->sql = file_get_contents("dump.sql");
		$this->sql = preg_replace("/AUTO_INCREMENT=.+? /","",$this->sql);
		$this->sql = preg_replace("/`cmsdev_(.+)`/","`".TABLE_PREFIX."$1`",$this->sql);
	}

	public function create() {
		preg_match_all("/^(SET|CREATE)(.|\r|\n)*?;$/m",$this->sql,$sqls);
		foreach ($sqls[0] as $sql) {
			echo $sql;
			$this->dbh->query($sql);
		}
		$sql = "INSERT INTO ".TABLE_PREFIX."account (username,password,email,role) VALUES(?,?,?,?)";
		$values = array("admin",md5("admin"),"","admin");
		$sth = $this->dbh->prepare($sql);
		$sth->execute($values);
	}

	public function drop() {
		preg_match_all("/^(DROP)(.|\r|\n)*?;$/m",$this->sql,$sqls);
		foreach ($sqls[0] as $sql) {
			echo $sql;
			$this->dbh->query($sql);
		}
	}
}
?>
