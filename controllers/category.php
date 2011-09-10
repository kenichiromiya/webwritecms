<?php
include_once("controller.php");
include_once("models/category.php");

class CategoryController extends Controller
{
	public $categorymodel = '';
	public $var = '';

	public function __construct() {
		parent::__construct();

		$this->categorymodel = new CategoryModel();

		$this->auth();
	}

	public function index() {
		if ($this->param['method'] == "GET") {
		} elseif ($this->param['method'] == "POST") {
			$this->categorymodel->editcategory($this->param);
			header("Location:".$this->base."category/admin/");
		} elseif ($this->param['method'] == "PUT") {
			$this->categorymodel->addcategory($this->param);
			header("Location:".$this->base."category/admin/");
		} elseif ($this->param['method'] == "DELETE") {
			$this->categorymodel->deletecategory($this->param);
			header("Location:".$this->base."category/admin/");
		}
	}

	public function edit() {

		if ($this->param['id']) {
			$category = $this->categorymodel->getcategory($this->param);
			$this->var['_method'] = "post";
		} else {
			$category = array('id'=>'','parent_id'=>$this->param['parent_id'],'name'=>'','path'=>'');
			$this->var['_method'] = "put";
		}

		$this->var['category'] = $category;
		$this->var['main'] = $this->view->getcontents("category_edit.php",$this->var);

		$this->view->display("admin.php",$this->var);
	}
}
?>
