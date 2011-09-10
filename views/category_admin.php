<div class="tree">
<?php
echo category_admin_html_create($categorytree);

function category_admin_html_create($data=array(),$depth = 0){

	$html .= "<ul>\n";
	if(is_array($data)){
		foreach($data as $key => $value){
			if (isset($data[$key+1])) {
				$html .= "<li>\n";
			} else {
				$html .= "<li class=\"lastitem\">\n";
			}
			$name = $value['name'];
			$id = $value['id'];
			$html .= $name."[<a href=\"category/edit/?parent_id=$id\">Add</a>] [<a href=\"category/$id/edit/\">Edit</a>]";
			$html .= "<form class=\"delete\" action=\"category/$id/\" method=\"post\">
				<input type=\"hidden\" name=\"_method\" value=\"delete\">
				<input type=\"submit\" value=\"delete\" onclick=\"return confirm('delete this category?');\">
				</form>";
			if(is_array($value['child'])) {
				$html .= category_admin_html_create($value['child'],$depth+1);
			}
			$html .= "</li>\n";
		}
	}
	$html .= "</ul>\n";
	return $html;
}
?>
</div>
