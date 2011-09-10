<?php

class CategoryModel extends Model
{

	public $categories;

        public function __construct() {
                parent::__construct();
		$sql = sprintf("SELECT * FROM %s",TABLE_PREFIX."category");
		$result = mysql_query($sql,$this->db);
		$categories = array();
		while ($row=mysql_fetch_assoc($result)){
			array_push($categories,$row);
		}
		$this->categories = $categories;
        }

	public function addcategory($param) {
		$query = sprintf("INSERT INTO %s (name,parent_id) VALUES('%s','%s')",TABLE_PREFIX."category",m($param['name']),m($param['parent_id']));
		mysql_query($query,$this->db);
	}

	public function editcategory($param) {
		$query = sprintf("UPDATE %s SET name = '%s' WHERE id = '%s'",TABLE_PREFIX."category",m($param['name']),m($param['id']));
		mysql_query($query,$this->db);
	}

	public function deletecategory($param) {
		$query = sprintf("DELETE FROM %s WHERE id = '%s'",TABLE_PREFIX."category",m($param['id']));
		mysql_query($query,$this->db);
	}

	public function initcategory() {
		$sql = sprintf("SELECT count(*) FROM %s",TABLE_PREFIX."category");
		$result = mysql_query($sql,$this->db);
		$count = mysql_result($result,0);
		if(!$count){
			$query = sprintf("INSERT INTO %s (name,parent_id) VALUES('top',0)",TABLE_PREFIX."category");
			mysql_query($query,$this->db);
		}
	}

	public function getcategory($param) {
		$sql = sprintf("SELECT * FROM %s WHERE id = '%s'",TABLE_PREFIX."category",m($param['id']));
		$result = mysql_query($sql,$this->db);
		$category=mysql_fetch_assoc($result);
		return $category;
	}

	public function getcategorytree() {
		/*
		if (!$this->categorytree){
			$sql = sprintf("SELECT * FROM %s",TABLE_PREFIX."category");
			$result = mysql_query($sql,$this->db);
			$categorys = array();
			while ($row=mysql_fetch_assoc($result)){
				array_push($categorys,$row);
			}
			$categorytree =  list_to_tree($categorys,'id','parent_id');
			$this->categorytree = $categorytree;
		} else {
			echo "aaa";
		}
		*/
		$categorytree =  list_to_tree($this->categories,'id','parent_id');
		return $categorytree;
	}

	public function getcategorypath($id)  {
		foreach ($this->categories as $category) {
			if ($category['id'] == $id) {
				$name = $this->getcategorypath($category['parent_id']);
				array_push($name,$category['name']);
				return $name;
			}
		}
		$name = array();
		return $name;
	}
}
?>
