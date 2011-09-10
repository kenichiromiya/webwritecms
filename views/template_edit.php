<div class="box">
<form id="edit" action="template/<?php if ($template['filename']) {echo $template['filename']."/";} ?>" method="post">
<input type="hidden" name="_method" value="<?=$_method?>">
<label for="filename"><?=$_LANG['filename']?></label><input id="filename" type="text" name="filename" value="<?=$template['filename']?>">
<?=$error['filename']?>
<label for="editor"><?=$_LANG['contents']?></label>
<textarea id="texteditor" name="contents">
<?=$template['contents']?>
</textarea>
<?=$error['contents']?>
<?php //include("wysiwygeditor.php")?>
<input type="submit" value="submit">
</form>
</div>
