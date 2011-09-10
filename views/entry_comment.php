<h3 id="comments">コメント</h3>
<!-- comment -->
<?php foreach ($comments as $num => $comment) { ?>
<span class="commenttitle"><?php echo $num+1?><?=$comment['title']?></span>
<span class="commentname"><?=$comment['name']?></span>
<span class="commentadddate"><?=$comment['adddate']?></span>
<div class="commentbody"><?=$comment['body']?></div>
<?php
}
?>

<form id="comment" method="post" action="comment/<?=$entry['id']?>/">
<input type="hidden" name="_method" value="put">
<label class="label" for="name"><?=$_LANG['entry_name']?></label>
<input class="input" id="name" type="text" name="name" size="20"/>
<label class="label" for="url"><?=$_LANG['entry_url']?></label>
<input class="input" id="url" type="text" name="url"/>
<label class="label" for="body"><?=$_LANG['entry_body']?></label>
<textarea class="input" id="body" name="body">
</textarea>
<label class="label" for="submit"></label>
<input class="input" id="submit" type="submit" value="<?=$_LANG['entry_post_comment']?>"/><br/>

</form>
