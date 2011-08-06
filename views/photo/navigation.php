<?php if($next){ ?>
<span id="next">
&lt; <a href="photo/<?=$next['id']?>/"><?=$_LANG['next']?></a>
</span>
<?php } else { ?>
<span id ="next"></span>
<?php }?>
<?php if($prev){ ?>
<span id="prev">
<a href="photo/<?=$prev['id']?>/"><?=$_LANG['prev']?></a> &gt;
</span>
<?php } else { ?>
<span id ="prev"></span>
<?php }?>
