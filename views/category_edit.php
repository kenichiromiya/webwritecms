<form action="category/<?php if ($category['id']) {echo $category['id']."/";} ?>" method="POST">
<input type="hidden" name="_method" value="<?=$_method?>">
<input type="hidden" name="parent_id" value="<?=$category['parent_id']?>">
<table>
<tr>
<td><?=$_LANG['category_name']?></td><td><input type="text" name="name" value="<?=$category['name']?>"></td>
</tr>
<tr>
<td></td><td><input type="submit" name="add" value="<?=$_LANG['category_submit']?>"></td>
</tr>
</table>
</form>
