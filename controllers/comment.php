<?php
include_once("controllers/cms.php");
include_once("models/comment.php");

class CommentController extends CMSController {
        public $commentmodel = '';

        public function __construct() {
                parent::__construct();
                $this->commentmodel = new CommentModel();
	}

	function put(){
		$this->commentmodel->addcomment($this->param);
		header("Location:".$this->base."entry/".$this->param['id']."/");
	}

}
?>
