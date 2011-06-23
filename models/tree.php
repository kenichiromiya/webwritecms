<?php
function tree_view($data=array(),$root = true){

	$html .= "<ul>\n";
	if(is_array($data)){
		foreach($data as $key => $value){
			if (isset($data[$key+1]) or $root) {
				$html .= "<li>\n";
			} else {
				$html .= "<li class=\"lastitem\">\n";
			}
			$name = $value['name'];
			$id = $value['id'];
			if ($root) {
				$checked = " checked=\"checked\" ";
			} else {
				$checked = "";
			}
			//$html .= "<input type=\"radio\" name=\"id\" value=\"$id\" $checked>";
			//$html .= "<a href=\"edit.php?id=$id\"> $name</a>";
			$html .= $name."[<a href=\"menuedit.php?id=$id\">Add</a>] [<a href=\"menuedit.php?id=$id\">Delete</a>]";
			//print_r($value);
			if(is_array($value['child'])) {
				$html .= tree_view($value['child'],false);
				//$aaa[] = $value;
			} 
			$html .= "</li>\n";
		}
	}
	$html .= "</ul>\n";
	return $html;
}

//http://www.php-z.net/c10/n84.html
function list_to_tree($category = array(),
		$idField = 'id',$parentField='parent_id'){
	if(!is_array($category)) exit("配列ではありません");

	$index = array();
	$tree = array();

	foreach($category as $value){
		$id     = $value[$idField];
		$parent = $value[$parentField];

		if(isset($index[$id])){
			$value['child'] = $index[$id]['child'];
			$index[$id] = $value;

		} else {
			$index[$id] = $value;	
		}

		if($parent == 0){
			$tree[] =& $index[$id];

		} else {
			$index[$parent]['child'][] =& $index[$id];
		}


	}
	return $tree;	
}

?>
