<?php
/*
if(!$session['username']){
	//header("Location:".BASE_URI."login.php?done=".$_VAR['done']);
	header("Location:login.php?done=$done");
}
*/
class Model
{
	public function __construct() {
                global $post;
                global $get;
                global $request;
                $this->post = $post;
                $this->get = $get;
                $this->request = $request;
		$classname = get_class($this);
		preg_match("/(.*?)Model/",$classname,$m);
		$this->table = strtolower($m[1]);
	}

}
?>
