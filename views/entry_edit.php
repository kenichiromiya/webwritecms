<div class="box">
<form id="edit" action="entry/<?php if ($entry['id']) {echo $entry['id']."/";} ?>" method="post">
<input type="hidden" name="_method" value="<?=$_method?>">
<label for="title"><?=$_LANG['title']?></label><input id="title" type="text" name="title" value="<?=$entry['title']?>">
<?=$error['title']?>
<label for="category"><?=$_LANG['category']?></label>
<select name="category_id">
<?php
?>
<?php
echo category_edit_html_create($categorytree,$entry);

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

?>
</select>
<textarea id="editor" name="body">
<?=$entry['body']?>
</textarea>
<?=$error['body']?>
<?php include("wysiwygeditor.php")?>
<input type="submit" value="submit">
</form>
</div>
