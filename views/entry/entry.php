<div class="box">
<?php
if ($session['username']){
?>
<a href="entry/<?php echo $entry['id']?>/edit/"><?php echo $_LANG['edit']?></a>
<?php
}
?>

<h2 class="title"><?=$entry['title']?></h2>
<div class="adddate"><?=$entry['adddate']?></div>
<div class="categorypath">
<?php
echo implode("/",$categorypath);
?>
</div>
<?=$entry['body']?>

<?php $commentnum = isset($commentnum) ? $commentnum : '0';?>
<div class="commentlink"><a href="entry/<?php echo $entry['id']?>/#comments"><?=$_LANG['entry_comment']?>(<?=$commentnum?>)</a></div>
<?=$comment?>
</div>
