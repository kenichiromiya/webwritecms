<?php

class AdminController extends Controller
{
        public function __construct() {
		parent::__construct();

		/*
                $session = $this->sessionmodel->getsession();
                if(!$session['username']){
                        $done = getdone();
                        $base = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI']);
                        header("Location:".$base."/session/?done=$done");
                }
		*/
		$this->auth();
		if (preg_match("/p(\d+)/",$this->param['id'],$m)){
			$this->param['p'] = $m[1];
		}
        }

/*
	public function page() {
		include_once("models/page.php");
		$this->pagemodel = new PageModel();
		$this->param['n'] = isset($this->param['n']) ? $this->param['n'] : '10';
		$this->param['p'] = isset($this->param['p']) ? $this->param['p'] : '1';
		$pages = $this->pagemodel->getpages($this->param);
		$this->var['pages'] = $pages;
		$this->var['main'] = $this->view->getcontents("page_admin.php",$this->var);
		$this->view->display("admin.php",$this->var);
	}

	public function entry() {
		include_once("models/entry.php");
		$this->entrymodel = new EntryModel();
		$this->param['n'] = 10;
		$entries = $this->entrymodel->getentries($this->param);
		$this->var['entries'] = $entries;
		$this->var['main'] = $this->view->getcontents("entry_admin.php",$this->var);
		$page = isset($this->param['p']) ? $this->param['p'] : '1';
		$count = $this->entrymodel->getcount($this->param);
		$this->var['pagenation'] = getpagenation(array('cur_page'=>$page,'per_page'=>$this->param['n'],'total_rows'=>$count));
		$this->var['main'] .= $this->view->getcontents("pagenation.php",$this->var);
		$this->view->display("admin.php",$this->var);
	}

	public function account() {
		include_once("models/account.php");
		$this->accountmodel = new AccountModel();
		$this->var['accounts'] = $this->accountmodel->getaccounts();
		$this->var['main'] = $this->view->getcontents("account_admin.php",$this->var);
		$this->view->display("admin.php",$this->var);
	}

	public function category() {
		include_once("models/category.php");
		$this->categorymodel = new CategoryModel();
		$this->categorymodel->initcategory();
		$this->var['categorytree'] =$this->categorymodel->getcategorytree() ;
		//print_r($a);

		$this->var['main'] = $this->view->getcontents("category_admin.php",$this->var);
		$this->view->display("admin.php",$this->var);
	}

	public function template() {
		include_once("models/template.php");
		$this->templatemodel = new TemplateModel();
		$dir_filenames = array();
		$filenames = scandir("views");
		//$tree = getDirectoryTree($this->dirname);
		//print_r($tree);
		//exit;
		foreach ($filenames as $filename) {
			if (preg_match("/php/",$filename,$m)) {
				array_push($dir_filenames,$filename);
			}
		}
		$templates = $this->templatemodel->getall();
		$db_filenames = array();
		foreach ($templates as $template) {
			array_push($db_filenames,$template['filename']);
		}

		$deletefilenames = array_diff($db_filenames,$dir_filenames);
		//print_r($deletefilenames);
		foreach ($deletefilenames as $filename) {
			$this->templatemodel->delete(array("filename"=>$filename));
		}
		$addfilenames = array_diff($dir_filenames,$db_filenames);
		//print_r($addfilename);
		foreach ($addfilenames as $filename) {
			$this->templatemodel->add(array("filename"=>$filename));
		}

		$this->var['_method'] = "put";
		$this->var['templates'] = $this->templatemodel->gettemplates();
		//print_r($templates);
		$this->var['main'] = $this->view->getcontents("template_admin.php",$this->var);
		$this->view->display("admin.php",$this->var);
	}

	public function upload() {
		include_once("models/upload.php");
		$this->uploadmodel = new UploadModel();
                $this->var['uploads'] = $this->uploadmodel->getuploads($this->param);
                //print_r($uploads);
                $this->var['main'] = $this->view->getcontents("upload_admin.php",$this->var);
                $count = $this->uploadmodel->getcount($this->param);
                $this->var['pagenation'] = getpagenation(array('cur_page'=>$this->param['p'],'per_page'=>$this->param['n'],'total_rows'=>$count));
                $this->var['main'] .= $this->view->getcontents("pagenation.php",$this->var);

                $this->view->display("upload_dialog.php",$this->var);
	}
	*/
	public function index() {
		if ($this->param['method'] == "GET") {
			$this->var['main'] = $this->view->getcontents("admin_detail.php",$this->var);
			$this->view->display("admin.php",$this->var);
			//$_VAR = $this->var;
		} elseif ($this->param['method'] == "POST") {
		} elseif ($this->param['method'] == "PUT") {
		} elseif ($this->param['method'] == "DELETE") {
		}
        }
}
?>
