<?php
class UploadController extends Controller
{
	public $uploadmodel;

        public function __construct() {
		parent::__construct();
		$this->uploadmodel = new UploadModel();
		//$this->menumodel = new MenuModel();

		if (!($this->param['method'] == "GET" and $this->param['action'] == "")) {
			$this->auth();
		}
		$this->dirname = "uploads";
		$this->param['n'] = 9;
		$this->var['num_per_page'] = $this->param['n'];
                if (!$this->param['id']) {
                        $this->param['p'] = 1;
                }
		$this->param['filename'] = $this->param['id'];
        }


	public function index() {
		if ($this->param['method'] == "GET") {
			$file_uploads = array();
			$files = scandir($this->dirname);
			foreach ($files as $file) {
				if (preg_match("/jpg|gif|png/",$file,$m)) {
					$file_uploads[$file] = filemtime($this->dirname."/".$file);
				}
			}
			$uploads = $this->uploadmodel->getalluploads();
			$db_uploads = array();
			foreach ($uploads as $upload) {
				$db_uploads[$upload['filename']] = $upload['addtime'];
			}
			$adduploads = array_diff_assoc($file_uploads,$db_uploads);
			$deleteuploads = array_diff_assoc($db_uploads,$file_uploads);
			$edituploads = array_intersect_key($adduploads,$deleteuploads);
			$adduploads = array_diff_key($adduploads,$edituploads);
			$deleteuploads = array_diff_key($deleteuploads,$edituploads);
			//print_r($adduploads);
			//print_r($deleteuploads);
			//print_r($edituploads);
			foreach ($deleteuploads as $filename => $addtime) {
				$this->uploadmodel->delete(array("filename"=>$upload['filename']));
				$this->deletefiles($filename);
			}
			foreach ($adduploads as $filename => $addtime) {

				$this->uploadmodel->add(array("filename"=>$filename,"addtime"=>$addtime));
				//imageresize($this->dirname."/thumbs/".$filename,$this->dirname."/".$filename,100,100);
				$this->resizefiles($filename);
			}

			foreach ($edituploads as $filename => $addtime) {
				$this->uploadmodel->edit(array("filename"=>$filename,"addtime"=>$addtime));
				//imageresize($this->dirname."/thumbs/".$name,$this->dirname."/".$name,100,100);
				$this->resizefiles($filename);
			}
			if ($this->param['p']) {
				$this->var['uploads'] = $this->uploadmodel->getuploads($this->param);
				//print_r($uploads);
				$this->var['main'] = $this->view->getcontents("upload_list.php",$this->var);
				$count = $this->uploadmodel->getcount($this->param);
				$this->var['pagenation'] = getpagenation(array('cur_page'=>$this->param['p'],'per_page'=>$this->param['n'],'total_rows'=>$count));
				$this->var['main'] .= $this->view->getcontents("pagenation.php",$this->var);

				$this->view->display("upload_dialog.php",$this->var);
			} else {
				$upload = $this->uploadmodel->get($this->param);
				//print_r($upload);
				$this->var['upload'] = $upload;
				$this->var['main'] = $this->view->getcontents("upload_detail.php",$this->var);
				//print_r($this->var['next']);
				//$this->var['main'] .= $this->view->getcontents("navigation.php",$this->var);
				$this->view->display("upload_dialog.php",$this->var);

			}
		} elseif ($this->param['method'] == "POST") {
		} elseif ($this->param['method'] == "PUT") {
			if ($_FILES["file"]["name"]) {
				$dirname = $this->dirname;
				if (!is_dir($dirname)){
					mkdir($dirname,0777,true);
				}
				$filename = $_FILES["file"]["name"];
				$upload_file = "$dirname/$filename";

				if(move_uploaded_file($_FILES["file"]["tmp_name"],$upload_file))
				{
					chmod($upload_file,0644);
				}
			}
			//$this->uploadmodel->addupload($this->param);
			$addtime = filemtime($upload_file);
			$this->uploadmodel->add(array("filename"=>$filename,"addtime"=>$addtime));
			$upload = $this->uploadmodel->getlastupload();
			$this->resizefiles($filename);
			header("Location:".$this->var['base']."upload/".$upload['filename']."/");
		} elseif ($this->param['method'] == "DELETE") {
			//$upload = $this->uploadmodel->get($this->param);
			$this->deletefiles($this->param['filename']);
			$this->uploadmodel->delete($this->param);
			header("Location:".$this->var['base']."upload/");
		}
	}

	public function resizefiles($filename) {
		imageresize($this->dirname."/large/".$filename,$this->dirname."/".$filename,400,400);
		imageresize($this->dirname."/middle/".$filename,$this->dirname."/large/".$filename,200,200);
		imageresize($this->dirname."/small/".$filename,$this->dirname."/middle/".$filename,100,100);
	}
	public function deletefiles($filename) {
		if(file_exists($this->dirname."/".$filename)) {
			unlink($this->dirname."/".$filename);
		}
		if(file_exists($this->dirname."/small/".$filename)) {
			unlink($this->dirname."/small/".$filename);
		}
		if(file_exists($this->dirname."/middle/".$filename)) {
			unlink($this->dirname."/middle/".$filename);
		}
		if(file_exists($this->dirname."/large/".$filename)) {
			unlink($this->dirname."/large/".$filename);
		}
	}

/*
	public function admin() {
		$this->var['uploads'] = $this->uploadmodel->getuploads($this->param);
		//print_r($uploads);
		$this->var['main'] = $this->view->getcontents("upload_admin.php",$this->var);
		$count = $this->uploadmodel->getcount($this->param);
		$this->var['pagenation'] = getpagenation(array('cur_page'=>$this->param['p'],'per_page'=>$this->param['n'],'total_rows'=>$count));
		$this->var['main'] .= $this->view->getcontents("pagenation.php",$this->var);

		$this->view->display("upload_dialog.php",$this->var);
	}
*/

	public function edit() {
		$this->var['_method'] = "put";
		//print_r($uploads);
		$this->var['main'] = $this->view->getcontents("upload_edit.php",$this->var);
		$this->view->display("upload_dialog.php",$this->var);
	}
}

?>
