<?php

class TemplateController extends Controller
{

        public $templatemodel = '';
	public $template = '';
        public $var = '';

        public function __construct() {
		parent::__construct();
		//$this->param['contents'] = $_POST['contents'];
		$this->param['contents'] = stripslashes($_POST['contents']);

                $this->templatemodel = new TemplateModel();

		$this->auth();
		$this->param['filename'] = $this->param['id'];
        }

	public function index() {
		if ($this->param['method'] == "GET") {
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
			$this->view->display("template.php",$this->var);

		} elseif ($this->param['method'] == "POST") {
			file_put_contents("views/".$this->param['filename'],$this->param['contents']);
			header("Location:".$this->var['base']."admin/template/");
		} elseif ($this->param['method'] == "PUT") {
			file_put_contents("views/".$this->param['filename'],$this->param['contents']);
			header("Location:".$this->var['base']."admin/template/");
		} elseif ($this->param['method'] == "DELETE") {
			unlink("views/".$this->param['filename']);
			//$this->templatemodel->deletetemplate($this->param);
			header("Location:".$this->var['base']."admin/template/");
		}
	}


	public function edit() {
		if ($this->param['id']) {
			$template = $this->templatemodel->get($this->param);
			$template['contents'] = file_get_contents("views/".$template['filename']);
			$this->var['_method'] = "post";
		} elseif($this->param['action'] == "edit") {
			$template = array('filename'=>'','contents'=>'');
			$this->var['_method'] = "put";
		}
		$this->var['template'] = $template;
		$this->var['main'] = $this->view->getcontents("template_edit.php",$this->var);
		$this->view->display("template.php",$this->var);
	}
}
?>
