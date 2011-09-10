<div class="box">

<h2 class="title"><?=$entry['title']?></h2>
<div class="adddate"><?=$entry['adddate']?></div>
<div class="categorypath">
<?php
echo implode("/",$categorypath);
?>
</div>
<?=$entry['body']?>

<?php if ($session['role'] == 'admin'){?>
<div class="edit"><a href="entry/<?=$entry['id']?>/edit/"><?=$_LANG['edit']?></a></div>
<?php } ?>
<?php $commentnum = isset($commentnum) ? $commentnum : '0';?>
<div class="commentlink"><a href="entry/<?php echo $entry['id']?>/#comments"><?=$_LANG['entry_comment']?>(<?=$commentnum?>)</a></div>
<?=$comment?>
<?php
if ($session['username']){
?>
<?php
}
?>
</div>

<?php if($next){ ?>
<span id="next">
<a href="entry/<?=$next['id']?>/">&lt;&lt; <?=$next['title']?></a>
</span>
<?php } else { ?>
<span id ="next"></span>
<?php }?>
<?php if($prev){ ?>
<span id="prev">
<a href="entry/<?=$prev['id']?>/"><?=$prev['title']?> &gt;&gt;</a>
</span>
<?php } else { ?>
<span id ="prev"></span>
<?php }?>
