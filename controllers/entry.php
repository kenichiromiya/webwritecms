<?php

class EntryController extends Controller
{
	public $entrymodel = '';
	public $var = '';

	public function __construct() {
		parent::__construct();
		//$this->param['body'] = stripslashes(strip_tags($_POST['body'],"<h1><h2><h3><h4><h5><h6><p><a><b><br><img>"));
		$this->param['body'] = stripslashes(strip_tags($_POST['body'],"<h1><h2><h3><h4><h5><h6><p><a><b><br><img>"));
		//$this->param['body'] = html_entity_decode($_POST['body']);
		//echo $this->param['body'];
		
                //$this->menumodel = new MenuModel();
                $this->categorymodel = new CategoryModel();
		$this->entrymodel = new EntryModel();
		$this->commentmodel = new CommentModel();

		if (!($this->param['method'] == "GET" and ($this->param['action'] == "" or $this->param['action'] == "list"))) {
			$this->auth();
		}
		if (!$this->param['id']) {
			$this->param['p'] = 1;
		}
	}

	public function index() {
		if ($this->param['method'] == "GET") {
			$this->var['recententries'] = $this->entrymodel->getrecententries($this->param);
			if ($this->param['o'] == "text") {
				$this->var['recententries'] = $this->entrymodel->getrecententries($this->param);
				$this->view->display("entry_list.php",$this->var);
			} elseif ($this->param['p']) {
				$this->param['n'] = 3;
				//$this->var['menutree'] = $this->menumodel->getmenutree();
				$this->var['categorytree'] = $this->categorymodel->getcategorytree();
				//$this->var['header'] = $this->view->getcontents("menu/menu.php",$this->var);
				$entries = $this->entrymodel->getentries($this->param);
				$count = $this->entrymodel->getcount($this->param);
				foreach ($entries as $entry){
					$this->var['entry'] = $entry;
					$this->var['categorypath'] = $this->categorymodel->getcategorypath($entry['category_id']);
					$this->var['commentnum'] = $this->commentmodel->getcommentnum($entry['id']);
					$this->var['main'] .= $this->view->getcontents("entry_detail.php",$this->var);
				}
				//$this->var['htmlentries'] = $htmlentries;
				$page = isset($this->param['p']) ? $this->param['p'] : '1';
				$this->var['pagenation'] = getpagenation(array('cur_page'=>$page,'per_page'=>'3','total_rows'=>$count));
				$this->var['main'] .= $this->view->getcontents("pagenation.php",$this->var);
				//$this->var['entries'] = $entries;

				$date = $this->param['d'];
				$year = substr($date,0,4);
				$mon = substr($date,4,2);
				$this->var['calendar'] = $this->entrymodel->getcalendar($year,$mon);
				$this->view->display("entry.php",$this->var);
			} else {
				//$this->var['menutree'] = $this->menumodel->getmenutree();
				$this->var['categorytree'] = $this->categorymodel->getcategorytree();
				//$this->var['header'] = $this->view->getcontents("menu/menu.php",$this->var);
				$entry = $this->entrymodel->get($this->param);
				$this->var['entry'] = $entry;
				$this->var['categorypath'] = $this->categorymodel->getcategorypath($entry['category_id']);
				$this->var['commentnum'] = $this->commentmodel->getcommentnum($entry['id']);
				$date = $entry['adddate'];
				$year = substr($date,0,4);
				$mon = substr($date,5,2);
				$this->var['calendar'] = $this->entrymodel->getcalendar($year,$mon);
				$this->var['comments'] = $this->commentmodel->getcomments($this->param);
				$this->var['comment'] = $this->view->getcontents("entry_comment.php",$this->var);
				$this->var['prev'] = $this->entrymodel->getpreventry($this->param);
				$this->var['next'] = $this->entrymodel->getnextentry($this->param);
				$this->var['main'] = $this->view->getcontents("entry_detail.php",$this->var);

				//$this->var['main'] .= $this->view->getcontents("navigation.php",$this->var);
				$this->view->display("entry.php",$this->var);

			}

		} elseif ($this->param['method'] == "POST") {
			$this->param['moddate'] = 'now()';
			$this->entrymodel->edit($this->param);
			header("Location:".$this->base."entry/".$this->param['id']."/");
		} elseif ($this->param['method'] == "PUT") {
			$this->param['adddate'] = 'now()';
			$this->param['moddate'] = 'now()';
			$this->entrymodel->add($this->param);
			//$this->entrymodel->insert($this->param);
			header("Location:".$this->base."entry/");
		} elseif ($this->param['method'] == "DELETE") {
			$this->entrymodel->delete($this->param);
			header("Location:".$this->base."entry/admin/");
		}
	}

	public function edit() {
		$this->var['recententries'] = $this->entrymodel->getrecententries($this->param);

		$this->entrymodel = new EntryModel();
		$date = date("Y-m-d H:i:s");
		$year = substr($date,0,4);
		$mon = substr($date,5,2);
		$this->var['calendar'] = $this->entrymodel->getcalendar($year,$mon);
		if ($this->param['id']) {
			$entry = $this->entrymodel->get($this->param);
			$this->var['_method'] = "post";
		} else {
			$entry = array('id'=>'','title'=>'','body'=>'','categoy_id'=>'');
			$this->var['_method'] = "put";
		}
		$this->var['categorytree'] = $this->categorymodel->getcategorytree();

		$this->var['entry'] = $entry;
		$this->var['main'] = $this->view->getcontents("entry_edit.php",$this->var);
		$this->view->display("entry.php",$this->var);
	}

	function admin() {
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
}
?>
