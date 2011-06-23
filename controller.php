<?php
/*
if(!$session['username']){
	//header("Location:".BASE_URI."login.php?done=".$_VAR['done']);
	header("Location:login.php?done=$done");
}
*/
class Controller
{
	public $post;
	public $get;
	public $template = '';

	public function __construct() {
                global $post;
                global $get;
                global $param;
                $this->post = $post;
                $this->get = $get;
		$this->param = $param;
		$this->template = new Template();
	}

	public function put() {
	}

	public function post() {
	}

	public function get() {
	}
}
?>
