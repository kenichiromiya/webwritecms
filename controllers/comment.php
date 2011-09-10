<?php

class CommentController extends Controller {
        public $commentmodel = '';

        public function __construct() {
                parent::__construct();
                $this->commentmodel = new CommentModel();
	}

	function put(){
		//$this->param['title'] = isset($this->param['title']) ? $this->param['title'] : '';
		//$this->param['url'] = isset($this->param['url']) ? $this->param['url'] : '';
		$this->commentmodel->addcomment($this->param);
		header("Location:".$this->base."entry/".$this->param['id']."/");
	}

}
?>
