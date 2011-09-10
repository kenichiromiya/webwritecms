<?php
function category_html_create($data=array(),$depth = 0){

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
                        $html .= $name;
                        //print_r($value);
                        if(is_array($value['child'])) {
                                $html .= treeview($value['child'],$depth+1);
                                //$aaa[] = $value;
                        }
                        $html .= "</li>\n";
                }
        }
        $html .= "</ul>\n";
        return $html;
}

function category_edit_html_create($data=array(),$args=array(),$depth = 0){

        if(is_array($data)){
                foreach($data as $key => $value){
                        $id = $value['id'];
                        $name = $value['name'];
                        if ($args['category_id'] == $id){
                                $selected = "selected";
                        } else {
                                $selected = "";
                        }
                        $html .= "<option value=\"$id\" $selected>\n";
                        for ($i=0;$i<$depth;$i++) {
                                $html .= "-";
                        }
                        $html .= $name;
                        if(is_array($value['child'])) {
                                $html .= category_edit_html_create($value['child'],$args,$depth+1);
                        }
                        $html .= "</option>\n";
                }
        }
        return $html;
}

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
			//print_r($value);
			if(is_array($value['child'])) {
				$html .= category_admin_html_create($value['child'],$depth+1);
				//$aaa[] = $value;
			}
			$html .= "</li>\n";
		}
	}
	$html .= "</ul>\n";
	return $html;
}
?>
