<div >
<img src="uploads/large/<?=$upload['filename']?>"/>
</div>
<!--
<?php if($next){ ?>
<span id="next">
<a href="photo/<?=$next['id']?>/">&lt;&lt; <?=$next['title']?></a>
</span>
<?php } else { ?>
<span id ="next"></span>
<?php }?>
<?php if($prev){ ?>
<span id="prev">
<a href="photo/<?=$prev['id']?>/"><?=$prev['title']?> &gt;&gt;</a>
</span>
<?php } else { ?>
<span id ="prev"></span>
<?php }?>
-->
<table>
<tr>
<td><?=$_LANG['position']?></td>
<td>
<input type="radio" name="position" onclick="position = 'none'" checked="checked"><?=$_LANG['none']?>
<input type="radio" name="position" onclick="position = 'left'"><?=$_LANG['left']?>
<input type="radio" name="position" onclick="position = 'center'"><?=$_LANG['center']?>
<input type="radio" name="position" onclick="position = 'right'"><?=$_LANG['right']?>
</td>
</tr>
<tr>
<td><?=$_LANG['size']?></td>
<td>
<input type="radio" name="imagesize" onclick="imagesize = 'small'" checked="checked"><?=$_LANG['small']?>
<input type="radio" name="imagesize" onclick="imagesize = 'middle'"><?=$_LANG['middle']?>
<input type="radio" name="imagesize" onclick="imagesize = 'large'"><?=$_LANG['large']?>
<input type="radio" name="imagesize" onclick="imagesize = 'original'"><?=$_LANG['original']?>
</td>
</tr>
</table>

<!--input class="use" type="button" value="<?=$_LANG['use']?>" onclick='window.opener.document.execCommand("insertimage",false,"uploads/thumbs/<?=$upload['name']?>");setposition();//self.window.close();'-->
<input class="use" type="button" value="<?=$_LANG['use']?>" onclick='setimage();setposition();self.window.close();'>
<script>
var imagesize = "small";
var position = "none";
function setimage() {
	switch (imagesize) {
		case 'small':
			window.opener.document.execCommand("insertimage",false,"uploads/small/<?=$upload['filename']?>");
			break;
		case 'middle':
			window.opener.document.execCommand("insertimage",false,"uploads/middle/<?=$upload['filename']?>");
			break;
		case 'large':
			window.opener.document.execCommand("insertimage",false,"uploads/large/<?=$upload['filename']?>");
			break;
		case 'original':
			window.opener.document.execCommand("insertimage",false,"uploads/<?=$upload['filename']?>");
			break;
	}
}
function setposition() {
	switch (position) {
		case 'left':
			window.opener.document.execCommand("justifyLeft");
			break;
		case 'center':
			window.opener.document.execCommand("justifyCenter");
			break;
		case 'right':
			window.opener.document.execCommand("justifyRight");
			break;
	}
}
</script>
