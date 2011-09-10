<form id="upload" action="upload/" method="post" enctype="multipart/form-data">
<input type="hidden" name="_method" value="<?=$_method?>"/>
<table id="gallery">
<tr>
<td><?=$_LANG['upload']?></td>
<td><input type="file" name="file" value=""/></td>
</tr>
<tr>
<td></td><td><input type="submit" value="Upload"/></td>
</tr>

<!--table id="gallery">
<tr>
<td><?=$_LANG['title']?></td><td><input type="text" name="title"></td>
</tr>
<tr>
<td><?=$_LANG['size']?></td><td><input type="radio" name="size"></td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="Submit"/></td>
</tr>
</table-->

<!--input class="use" type="button" value="<?=$_LANG['use']?>" onclick='window.opener.document.execCommand("insertimage",false,"uploads/thumbs/<?=$upload['filename']?>");self.window.close();'-->
</table>
</form>
