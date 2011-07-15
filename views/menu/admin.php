<div class="tree">
<?php
echo menu_admin_html_create($tree);
?>
</div>
<?php
function menu_admin_html_create($data=array(),$depth = 0){

	$html .= "<ul>\n";
	if(is_array($data)){
		foreach($data as $key => $value){
			if (isset($data[$key+1]) or $depth == 0) {
				$html .= "<li>\n";
			} else {
				$html .= "<li class=\"lastitem\">\n";
			}
			$name = $value['name'];
			$id = $value['id'];
			$html .= $name."[<a href=\"menu/edit/?parent_id=$id\">Add</a>] [<a href=\"menu/$id/edit/\">Edit</a>]";
			$html .= "<form class=\"delete\" action=\"menu/$id/\" method=\"post\">
				<input type=\"hidden\" name=\"_method\" value=\"delete\">
				<input type=\"submit\" value=\"delete\" onclick=\"return confirm('delete this menu?');\">
				</form>";
			//print_r($value);
			if(is_array($value['child'])) {
				$html .= menu_admin_html_create($value['child'],$depth+1);
				//$aaa[] = $value;
			}
			$html .= "</li>\n";
		}
	}
	$html .= "</ul>\n";
	return $html;
}
?>
