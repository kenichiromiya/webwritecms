<?php
include_once("controllers/cms.php");
include_once("models/category.php");

class CategoryController extends CMSController
{
	public $categorymodel = '';
	public $var = '';

	public function __construct() {
		parent::__construct();

		$this->categorymodel = new CategoryModel();

		$this->auth();
	}

	public function put() {
		$this->categorymodel->addcategory($this->param);
		header("Location:".$this->base."category/admin/");
	}

	public function post() {
		$this->categorymodel->editcategory($this->param);
		header("Location:".$this->base."category/admin/");
	}
	
	public function delete() {
		$this->categorymodel->deletecategory($this->param);
		header("Location:".$this->base."category/admin/");
	}

	public function get() {
		global $_LANG;

		if ($this->param['action'] == "edit") {
			if ($this->param['id']) {
				$category = $this->categorymodel->getcategory($this->param);
				$this->var['_method'] = "post";
			} else {
				$category = array('id'=>'','parent_id'=>$this->param['parent_id'],'name'=>'','path'=>'');
				$this->var['_method'] = "put";
			}

			$this->var['category'] = $category;
			$this->var['main'] = $this->template->getcontents("category/edit.php",$this->var);

		} elseif ($this->param['action'] == "admin") {

			$this->categorymodel->initcategory();
			$this->var['categorytree'] =$this->categorymodel->getcategorytree() ;
			//print_r($a);

			$this->var['main'] = $this->template->getcontents("category/admin.php",$this->var);

		}
		$this->template->display("admin/index.php",$this->var);
	}
}
?>
