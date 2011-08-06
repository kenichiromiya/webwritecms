<form id="photo" action="photo/" method="post" enctype="multipart/form-data">
<input type="hidden" name="_method" value="<?=$_method?>"/>
<table id="gallery">
<tr>
<td><?=$_LANG['photo']?></td>
<td><input type="file" name="file" value=""/></td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="Submit"/></td>
</tr>
</table>
</form>

<table id="gallery">
<?php
for ($j=0;$j<3;$j++){
	echo "<tr>";
	for ($i=0;$i<3;$i++){
		if(isset($photos[$j*3+$i])){
			$photo = $photos[$j*3+$i];
?>
<td>
<div class="photo">
<a href="photo/<?=$photo['id']?>/"><img src="photos/thumbs/<?=$photo['name']?>"/></a>
</div>
<!--input class="use" type="button" value="<?=$_LANG['use']?>" onclick='self.window.returnValue = "photos/thumbs/<?=$photo['name']?>";self.window.close();'-->
<input class="use" type="button" value="<?=$_LANG['use']?>" onclick='window.opener.document.execCommand("insertimage",false,"photos/thumbs/<?=$photo['name']?>")'>
<form class="delete" action="photo/<?=$photo['id']?>/" method="post">
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
