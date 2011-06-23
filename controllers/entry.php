<?php
include_once("controllers/cms.php");
include_once("models/menu.php");
include_once("models/entry.php");
include_once("models/comment.php");

class EntryController extends CMSController
{
	public $entrymodel = '';
	public $var = '';
        public $menumodel = '';

	public function __construct() {
		parent::__construct();
		$this->param['body'] = stripslashes(strip_tags($_POST['body'],"<h1><h2><h3><h4><h5><h6><p><a><b><br><img>"));
		$this->entrymodel = new EntryModel();
		$this->commentmodel = new CommentModel();
                $this->menumodel = new MenuModel();

		if (!($this->param['method'] == "GET" and $this->param['a'] == "")) {
			$this->auth();
		}
	}

	public function put() {
		$this->entrymodel->addentry($this->param);
		header("Location:".$this->base."entry/");
	}

	public function post() {
		$this->entrymodel->editentry($this->param);
                header("Location:".$this->base."entry/".$this->param['id']."/");
	}

	public function delete() {
		$this->entrymodel->deleteentry($this->param);
		header("Location:".$this->base."entry/");
	}

	public function get() {
		$this->var['recententries'] = $this->entrymodel->getrecententries();

		if ($this->param['a'] == "edit") {
			if ($this->param['id']) {
				$entry = $this->entrymodel->getentry($this->param);
				$this->var['_method'] = "post";
			} else {
				$entry = array('id'=>'','title'=>'','body'=>'','categoy_id'=>'');
				$this->var['_method'] = "put";
			}

			$this->var['entry'] = $entry;
			$this->var['main'] = $this->template->getcontents("entry/edit.php",$this->var);
			$this->template->display("admin/index.php",$this->var);
		} elseif ($this->param['a'] == "admin") {
			$this->param['n'] = 10;
			$entries = $this->entrymodel->getentries($this->param);
			$this->var['entries'] = $entries;
			$this->var['main'] = $this->template->getcontents("entry/admin.php",$this->var);

			$page = isset($this->param['p']) ? $this->param['p'] : '1';
			$count = $this->entrymodel->getcount($this->param);
			$this->var['pagenation'] = getpagenation(array('cur_page'=>$page,'per_page'=>$this->param['n'],'total_rows'=>$count));
			$this->var['main'] .= $this->template->getcontents("entry/pagenation.php",$this->var);
			$this->template->display("admin/index.php",$this->var);
		} elseif ($this->param['id']) {
			$menutree = $this->menumodel->getmenutree();
			$this->var['menutree'] = $menutree;
			$this->var['header'] = $this->template->getcontents("menu/menu.php",$this->var);
			$entry = $this->entrymodel->getentry($this->param);
			$this->var['entry'] = $entry;
			$date = $entry['adddate'];
			$year = substr($date,0,4);
			$mon = substr($date,5,2);
			$this->var['calendar'] = $this->entrymodel->getcalendar($year,$mon);
			$this->var['comments'] = $this->commentmodel->getcomments($this->param);
			$this->var['comment'] = $this->template->getcontents("entry/comment.php",$this->var);
			$this->var['main'] = $this->template->getcontents("entry/entry.php",$this->var);

			$this->var['prev'] = $this->entrymodel->getpreventry($this->param);
			$this->var['next'] = $this->entrymodel->getnextentry($this->param);
			$this->var['main'] .= $this->template->getcontents("entry/navigation.php",$this->var);
			$this->template->display("entry/index.php",$this->var);

		} else {
			$this->param['n'] = 3;
			$menutree = $this->menumodel->getmenutree();
			$this->var['menutree'] = $menutree;
			$this->var['header'] = $this->template->getcontents("menu/menu.php",$this->var);
			$entries = $this->entrymodel->getentries($this->param);
			foreach ($entries as $entry){
				$this->var['entry'] = $entry;
				$this->var['main'] .= $this->template->getcontents("entry/entry.php",$this->var);
			}
			//$this->var['htmlentries'] = $htmlentries;
			$page = isset($this->param['p']) ? $this->param['p'] : '1';
			$count = $this->entrymodel->getcount($this->param);
			$this->var['pagenation'] = getpagenation(array('cur_page'=>$page,'per_page'=>'3','total_rows'=>$count));
			$this->var['main'] .= $this->template->getcontents("entry/pagenation.php",$this->var);
			//$this->var['entries'] = $entries;

			$date = $this->param['d'];
			$year = substr($date,0,4);
			$mon = substr($date,4,2);
			$this->var['calendar'] = $this->entrymodel->getcalendar($year,$mon);
			$this->template->display("entry/index.php",$this->var);

		}

	}
}
?>
