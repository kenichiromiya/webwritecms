<ul>
<?php foreach($_VAR['archives'] as $archives) { ?>
<?php
list($year,$mon) = sscanf($archives['adddate'],"%04s%02s");
$adddate = "$year/$mon";
?>
<li><a href="entry/?d=<?=$archives['adddate']?>"><?=$adddate?>(<?=$archives['count']?>)</a></li>
<?php } ?>
</ul>
