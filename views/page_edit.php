<div class="box">
<form id="edit" action="page/<?php if ($page['id']) {echo $page['id']."/";} ?>" method="post">
<input type="hidden" name="_method" value="<?=$_method?>">
<label for="title"><?=$_LANG['title']?></label><input id="title" type="text" name="title" value="<?=$page['title']?>">
<?=$error['title']?>
<label for="editor"><?=$_LANG['body']?></label>
<textarea id="editor" name="body">
<?=$page['body']?>
</textarea>
<?=$error['body']?>
<?php include("wysiwygeditor.php")?>
<input type="submit" value="submit">
</form>
</div>
