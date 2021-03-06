<?php
include_once("controller.php");
include_once("models/menu.php");

class MenuController extends Controller
{
	public $menumodel = '';
	public $var = '';

	public function __construct() {
		parent::__construct();

		$this->menumodel = new MenuModel();

		$this->auth();
	}

	public function put() {
		$this->menumodel->addmenu($this->param);
		header("Location:".$this->base."menu/admin/");
	}

	public function post() {
		$this->menumodel->editmenu($this->param);
		header("Location:".$this->base."menu/admin/");
	}
	
	public function delete() {
		$this->menumodel->deletemenu($this->param);
		header("Location:".$this->base."menu/admin/");
	}

	public function get() {

		if ($this->param['action'] == "edit") {
			if ($this->param['id']) {
				$menu = $this->menumodel->getmenu($this->param);
				$this->var['_method'] = "post";
			} else {
				$menu = array('id'=>'','parent_id'=>$this->param['parent_id'],'name'=>'','path'=>'');
				$this->var['_method'] = "put";
			}

			$this->var['menu'] = $menu;
			$this->var['main'] = $this->template->getcontents("menu/edit.php",$this->var);

		} elseif ($this->param['action'] == "admin") {

			$this->menumodel->initmenu();
			$tree = $this->menumodel->getmenutree();
			$this->var['tree'] = $tree;
			//print_r($a);
			//$tree = "<div class=\"tree\">";
			//$tree .= $this->menumodel->tree_view($menutree);
			//$tree .= "</div>";
			//$this->var['tree'] = $tree;

			$this->var['main'] = $this->template->getcontents("menu/admin.php",$this->var);

		}
		$this->template->display("admin/index.php",$this->var);
	}
}
?>
