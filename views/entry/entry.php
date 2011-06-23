<div class="box">
<?php
if ($session['username']){
?>
<a href="entry/<?php echo $entry['id']?>/edit/"><?php echo $_LANG['edit']?></a>
<?php
}
?>

<h2 class="title"><?=$entry['title']?></h2>
<?=$entry['adddate']?>
<?=$entry['body']?>

<?php $commentnum = isset($entry['commentnum']) ? $entry['commentnum'] : '0';?>
<div class="commentlink"><a href="entry/<?php echo $entry['id']?>/#comments"><?=$_LANG['entry_comment']?>(<?=$commentnum?>)</a></div>
<?=$comment?>
</div>
