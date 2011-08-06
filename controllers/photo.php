<?php
include_once("controller.php");
include_once("models/photo.php");
include_once("models/menu.php");

/*
if(!$session['username']){
	//header("Location:".BASE_URI."login.php?done=".$_VAR['done']);
	header("Location:login.php?done=$done");
}
*/
class PhotoController extends Controller
{
	public $photomodel;

        public function __construct() {
		parent::__construct();
		$this->photomodel = new PhotoModel();
		$this->menumodel = new MenuModel();

		if (!($this->param['method'] == "GET" and $this->param['action'] == "")) {
			$this->auth();
		}
		$this->dirname = "photos";
		$this->param['n'] = 9;
        }

	public function put() {
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
                //$this->photomodel->addphoto($this->param);
                header("Location:".$this->var['base']."photo/admin/");
	}

	/*
	public function post() {
                $this->photomodel->editphoto($this->param);
                header("Location:".$this->var['base']."photo/admin/");
        }
	*/

        public function delete() {
		$photo = $this->photomodel->getphoto($this->param);
		unlink($this->dirname."/".$photo['name']);
		//echo $this->dirname."/".$photo['name'];
                //$this->photomodel->deletephoto($this->param);
                header("Location:".$this->var['base']."photo/admin/");
	}

	public function get() {
		if ($this->param['action'] == "edit") {
			$this->var['_method'] = "put";
			$this->var['main'] = $this->template->getcontents("photo/edit.php",$this->var);
			$this->template->display("admin/index.php",$this->var);
		} elseif ($this->param['action'] == "admin") {
			$file_photos = array();
			$files = scandir($this->dirname);
			foreach ($files as $file) {
				if (preg_match("/jpg|gif|png/",$file,$m)) {
					$mtime = filemtime($this->dirname."/".$file);
					array_push($file_photos,"$file#$mtime");
				}
			}
			$photos = $this->photomodel->getallphotos();
			$db_photos = array();
			foreach ($photos as $photo) {
				array_push($db_photos,$photo['name']."#".$photo['addtime']);
			}
			$addphotos = array_diff($file_photos,$db_photos);
			foreach ($addphotos as $addphoto) {

				list($name,$addtime) = explode("#",$addphoto);

				$this->photomodel->addphoto(array("name"=>$name,"addtime"=>$addtime));
				imageresize($this->dirname."/thumbs/".$name,$this->dirname."/".$name,100,100);
			}

			$deletephotos = array_diff($db_photos,$file_photos);
			//print_r($deletephotos);
			foreach ($deletephotos as $deletephoto) {
				list($name,$deletetime) = explode("#",$deletephoto);
				$photo = $this->photomodel->getphotobyname(array("name"=>$name));
				$this->photomodel->deletephoto(array("id"=>$photo['id']));
				if(file_exists($this->dirname."/thumbs/".$name)) {
					unlink($this->dirname."/thumbs/".$name);
				}
			}

			$this->var['_method'] = "put";
			$this->var['photos'] = $this->photomodel->getphotos($this->param);
			//print_r($photos);
			$this->var['main'] = $this->template->getcontents("photo/admin.php",$this->var);
			$count = $this->photomodel->getcount($this->param);
			$this->var['pagenation'] = getpagenation(array('cur_page'=>$this->param['p'],'per_page'=>$this->param['n'],'total_rows'=>$count));
			$this->var['main'] .= $this->template->getcontents("pagenation.php",$this->var);

			$this->template->display("admin/index.php",$this->var);
		} elseif($this->param['action'] == "dialog") {
			$this->var['photos'] = $this->photomodel->getphotos($this->param);
			//print_r($photos);
			$this->var['main'] = $this->template->getcontents("photo/admin.php",$this->var);
			$count = $this->photomodel->getcount($this->param);
			$this->var['pagenation'] = getpagenation(array('cur_page'=>$this->param['p'],'per_page'=>$this->param['n'],'total_rows'=>$count));
			$this->var['main'] .= $this->template->getcontents("pagenation.php",$this->var);

			$this->template->display("photo/dialog.php",$this->var);
		} elseif ($this->param['id']) {
			$this->var['menutree'] = $this->menumodel->getmenutree();
			$this->var['header'] = $this->template->getcontents("menu/menu.php",$this->var);
			$photo = $this->photomodel->getphoto($this->param);
			$this->var['photo'] = $photo;
			$this->var['main'] = $this->template->getcontents("photo/photo.php",$this->var);

			$this->var['prev'] = $this->photomodel->getprevphoto($this->param);
			$this->var['next'] = $this->photomodel->getnextphoto($this->param);
			//print_r($this->var['next']);
			$this->var['main'] .= $this->template->getcontents("photo/navigation.php",$this->var);
			$this->template->display("photo/index.php",$this->var);

		} else {
                        $menutree = $this->menumodel->getmenutree();
                        $this->var['menutree'] = $menutree;
                        $this->var['header'] = $this->template->getcontents("menu/menu.php",$this->var);
			$this->var['photos'] = $this->photomodel->getphotos($this->param);
			//print_r($photos);
			$this->var['main'] = $this->template->getcontents("photo/photothumb.php",$this->var);
			$count = $this->photomodel->getcount($this->param);
			$this->var['pagenation'] = getpagenation(array('cur_page'=>$this->param['p'],'per_page'=>$this->param['n'],'total_rows'=>$count));
			$this->var['main'] .= $this->template->getcontents("pagenation.php",$this->var);
			$this->template->display("photo/index.php",$this->var);
		}
	}

	function imageresize($newfilename,$filename,$max_width,$max_height) {
		list($width, $height,$imagetype) = getimagesize($filename);

		$ratio = $width/$height;

		if ($ratio > 1) {
			$new_width = $max_width;
			$new_height = $max_height/$ratio;
		} else {
			$new_width = $max_width*$ratio;
			$new_height = $max_height;
		}

		$image_p = imagecreatetruecolor($new_width, $new_height);
		switch ($imagetype)
		{
			case 1:
				$image = imagecreatefromgif($filename);
				break;
			case 2:
				$image = imagecreatefromjpeg($filename);
				break;
			case 3:
				$image = imagecreatefrompng($filename);
				break;
		}
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		//$matrix = array(array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1));
		//imageconvolution($image_p, $matrix, 8, 0);

		imagejpeg($image_p, $newfilename, 95);
	}
}

?>
