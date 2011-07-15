<form action="menu/<?php if ($menu['id']) {echo $menu['id']."/";} ?>" method="POST">
<input type="hidden" name="_method" value="<?=$_method?>">
<input type="hidden" name="parent_id" value="<?=$menu['parent_id']?>">
<table>
<tr>
<td><?=$_LANG['menu_name']?></td><td><input type="text" name="name" value="<?=$menu['name']?>"></td>
</tr>
<tr>
<td><?=$_LANG['menu_path']?></td><td><input type="text" name="path" value="<?=$menu['path']?>"></td>
</tr>
<tr>
<td></td><td><input type="submit" name="add" value="<?=$_LANG['menu_submit']?>"></td>
</tr>
</table>
</form>
