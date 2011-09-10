<!--form id="upload" action="upload/" method="post" enctype="multipart/form-data">
<input type="hidden" name="_method" value="<?=$_method?>"/>
<table id="gallery">
<tr>
<td><?=$_LANG['upload']?></td>
<td><input type="file" name="file" value=""/></td>
</tr>
<tr>
<td><?=$_LANG['size']?></td><td><input type="radio" name="size"></td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="Submit"/></td>
</tr>
</table>
</form-->

<table id="gallery">
<?php
for ($j=0;$j<$num_per_page/3;$j++){
	echo "<tr>";
	for ($i=0;$i<3;$i++){
		if(isset($uploads[$j*3+$i])){
			$upload = $uploads[$j*3+$i];
?>
<td>
<div class="upload">
<a href="upload/<?=$upload['filename']?>/"><img src="uploads/small/<?=$upload['filename']?>"/></a>
</div>
<!--input class="use" type="button" value="<?=$_LANG['use']?>" onclick='self.window.returnValue = "uploads/thumbs/<?=$upload['filename']?>";self.window.close();'-->
<!--input type="radio" name="upload" onclick="filename = '<?=$upload['filename']?>';" value="<?=$upload['id']?>"-->
<!--input class="use" type="button" value="<?=$_LANG['use']?>" onclick='window.opener.document.execCommand("insertimage",false,"uploads/thumbs/<?=$upload['name']?>");self.window.close();'-->
<a href="upload/<?=$upload['filename']?>/edit/"><?=$_LANG['edit']?></a>
<form class="delete" action="upload/<?=$upload['filename']?>/" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?=$_LANG['delete']?>">
</form>
</td>
<?php
		} else {
			echo "<td></td>";
		}
	}
	echo "</tr>";
}
?>
</table>
