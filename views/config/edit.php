<form id="config" action="config/" method="post" enctype="multipart/form-data">
<input type="hidden" name="_method" value="<?=$_method?>">
<table>
<tr>
<td><?=$_LANG['config_title']?></td><td><input id="title" type="text" name="title" value="<?=$config['title']?>"></td>
</tr>
<!--
<tr>
<td><?=$_LANG['config_main_img']?></td><td><input type="file" name="file" value="<?=$config['main_img']?>"></td>
</tr>
-->
<tr>
<td><?=$_LANG['config_copyright']?></td><td><input id="copyright" type="text" name="copyright" value="<?=$config['copyright']?>"></td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="Submit"/></td>
</tr>
</table>
</form>
