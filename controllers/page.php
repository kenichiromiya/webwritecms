<?php
include_once("controllers/cms.php");
include_once("models/page.php");
include_once("models/menu.php");

class PageController extends CMSController
{
	public $pagemodel = '';
	public $menumodel = '';

	public function __construct() {
		parent::__construct();
		$this->param['body'] = stripslashes(strip_tags($_POST['body'],"<h1><h2><h3><h4><h5><h6><p><a><b><br><img><strong>"));
		$this->pagemodel = new PageModel();
		$this->menumodel = new MenuModel();

                if (!($this->param['method'] == "GET" and $this->param['action'] == "")) {
			$this->auth();
                }
		//print_r($session);
	}

	public function put() {
		$this->pagemodel->addpage($this->param);
		header("Location:".$this->base."page/");
	}

	public function post() {
		$this->pagemodel->editpage($this->param);
		header("Location:".$this->base."page/".$this->param['id']."/");
	}

	public function delete() {
		$this->pagemodel->deletepage($this->param);
		header("Location:".$this->base."page/");
	}

	public function get() {
		$this->var['recentpages'] = $this->pagemodel->getrecentpages();
		if ($this->param['action'] == "edit") {
			if ($this->param['id']) {
				$page = $this->pagemodel->getpage($this->param);
				$this->var['_method'] = "post";
			} else {
				$page = array('id'=>'','title'=>'','body'=>'','categoy_id'=>'');
				$this->var['_method'] = "put";
			}
			$this->var['page'] = $page;
			$this->var['main'] = $this->template->getcontents("page/edit.php",$this->var);
			$this->template->display("admin/index.php",$this->var);
		}elseif ($this->param['action'] == "admin") {
			$this->param['n'] = isset($this->param['n']) ? $this->param['n'] : '10';
			$this->param['p'] = isset($this->param['p']) ? $this->param['p'] : '1';
			$pages = $this->pagemodel->getpages($this->param);
			$this->var['pages'] = $pages;
			$this->var['main'] = $this->template->getcontents("page/admin.php",$this->var);
			$this->template->display("admin/index.php",$this->var);
		} else {
			$this->param['id'] = isset($this->param['id']) ? $this->param['id'] : '1';
			$menutree = $this->menumodel->getmenutree();
			$this->var['menutree'] = $menutree;
			$this->var['header'] = $this->template->getcontents("menu/menu.php",$this->var);
			$page = $this->pagemodel->getpage($this->param);
			$this->var['page'] = $page;
			$this->var['main'] = $this->template->getcontents("page/page.php",$this->var);
			$this->template->display("page/index.php",$this->var);
		}
	}
}

?>
