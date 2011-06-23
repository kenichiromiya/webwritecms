<?php if($next){ ?>
<span id="next">
&lt; <a href="entry/<?=$next['id']?>/"><?=$next['title']?></a>
</span>
<?php } else { ?>
<span id ="next"></span>
<?php }?>
<?php if($prev){ ?>
<span id="prev">
<a href="entry/<?=$next['id']?>/"><?=$prev['title']?></a> &gt;
</span>
<?php } else { ?>
<span id ="prev"></span>
<?php }?>
