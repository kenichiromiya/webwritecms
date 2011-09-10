<?php

class PageController extends Controller
{

	public function __construct() {
		parent::__construct();
		$this->param['body'] = stripslashes(strip_tags($_POST['body'],"<h1><h2><h3><h4><h5><h6><p><a><b><br><img><strong><table><tr><td><div><span>"));
		//$this->param['body'] = stripslashes(html_entity_decode($_POST['body']));
		$this->pagemodel = new PageModel();
		
		//$this->menumodel = new MenuModel();
		//$this->sessionmodel = new SessionModel();
		//$this->loadmodel("page");
		//$this->loadmodel("menu");

		//$this->var['session'] = $this->sessionmodel->getsession();
                if (!($this->param['method'] == "GET" and $this->param['action'] == "")) {
			$this->auth();
                }
	}

	public function index() {
		if ($this->param['method'] == "GET") {
			$this->param['id'] = isset($this->param['id']) ? $this->param['id'] : '1';
			//$menutree = $this->menumodel->getmenutree();
			//$this->var['menutree'] = $menutree;
			//$this->var['header'] = $this->view->getcontents("menu/menu.php",$this->var);
			//$page = $this->pagemodel->getpage($this->param);
			$page = $this->pagemodel->get($this->param);
			$this->var['page'] = $page;
			$this->var['main'] = $this->view->getcontents("page_detail.php",$this->var);
			$this->var['recentpages'] = $this->pagemodel->getrecentpages();
			$this->view->display("page.php",$this->var);
		} elseif ($this->param['method'] == "POST") {
			if ($this->pagemodel->validate($this->param)) {
				setcookie("page", "",time() - 3600,'/');
				setcookie("error", "",time() - 3600,'/');
				//$this->pagemodel->editpage($this->param);
				$this->param['moddate'] = 'now()';
				$this->pagemodel->edit($this->param);
				//$param = array_intersect_key($this->param,array_fill_keys(array('title','body','id'),''));
				//$param['adddate'] = 'now()';
				//$this->pagemodel->edit($param);
				header("Location:".$this->base."page/".$this->param['id']."/");
			} else {
				setcookie("page",serialize($this->param),0,'/');
				setcookie("error",serialize($this->pagemodel->error),0,'/');
				header("Location:".$this->base."page/".$this->param['id']."/edit/");
			}
		} elseif ($this->param['method'] == "PUT") {
			$this->param['adddate'] = 'now()';
			$this->param['moddate'] = 'now()';
			//$this->pagemodel->addpage($this->param);
			$this->pagemodel->add($this->param);
			header("Location:".$this->base."page/");
		} elseif ($this->param['method'] == "DELETE") {
			$this->pagemodel->delete($this->param);
			header("Location:".$this->base."page/");
		}
	}

	public function edit() {
		$this->var['recentpages'] = $this->pagemodel->getrecentpages();
		if ($this->param['action'] == "edit") {
			if ($this->param['id']) {
				if ($_COOKIE['page']){
					//echo "aaa";
					//echo $_COOKIE['page'];
					$page = unserialize(stripslashes($_COOKIE['page']));
					$error = unserialize(stripslashes($_COOKIE['error']));
					setcookie("page", "",time() - 3600,'/');
					setcookie("error", "",time() - 3600,'/');
				} else {
					//$page = $this->pagemodel->getpage($this->param);
					$page = $this->pagemodel->get($this->param);
				}
				$this->var['_method'] = "post";
			} else {
				$page = array('id'=>'','title'=>'','body'=>'','categoy_id'=>'');
				$this->var['_method'] = "put";
			}
			$this->var['page'] = $page;
			$this->var['error'] = $error;
			$this->var['main'] = $this->view->getcontents("page_edit.php",$this->var);
			$this->view->display("page.php",$this->var);
		}
	}

}

?>
