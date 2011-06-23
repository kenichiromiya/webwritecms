<div class="box">
<form id="edit" action="entry/<?php if ($entry['id']) {echo $entry['id']."/";} ?>" method="post">
<input type="hidden" name="_method" value="<?=$_method?>">
<label for="title"><?=$_LANG['title']?></label><input id="title" type="text" name="title" value="<?=$entry['title']?>">
<textarea id="editor" name="body">
<?=$entry['body']?>
</textarea>
<?php include("wysiwygeditor.php")?>
<input type="submit" value="submit">
</form>
</div>
