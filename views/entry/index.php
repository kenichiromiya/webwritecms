<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?=$config['title']?></title>
<base href="<?=$base?>"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<div id="wrapper">
<?php include("header.php")?>

<div id="contents">
<?php //include("editmenu.php")?>

<div id="main">
<?=$main?>
</div>

<div id="sidebar">
<div class="box">
<?=$calendar?>
</div>
<div class="box">
<ul>
<?php foreach($recententries as $recententry) { ?>
<li><a href="entry/<?=$recententry['id']?>/"><?=$recententry['title']?></a></li>
<?php } ?>
</ul>
</div>
<div class="box">
<?php
echo category_html_create($categorytree);

function category_html_create($data=array(),$depth = 0){

        $html .= "<ul>\n";
        if(is_array($data)){
                foreach($data as $key => $value){
                        if (isset($data[$key+1]) or $depth == 0) {
                                $html .= "<li>\n";
                        } else {
                                $html .= "<li class=\"lastitem\">\n";
                        }
                        $name = $value['name'];
                        $id = $value['id'];
                        $html .= "<a href=\"entry/?c=$id\">$name</a>";
                        if(is_array($value['child'])) {
                                $html .= category_html_create($value['child'],$depth+1);
                        }
                        $html .= "</li>\n";
                }
        }
        $html .= "</ul>\n";
        return $html;
}
?>
</div>
</div>

</div>

<?php include("footer.php")?>
</div>
</body>
</html>
<?php
function treeview($data=array(),$depth = 0){

        $html .= "<ul>\n";
        if(is_array($data)){
                foreach($data as $key => $value){
                        if (isset($data[$key+1]) or $depth == 0) {
                                $html .= "<li>\n";
                        } else {
                                $html .= "<li class=\"lastitem\">\n";
                        }
                        $name = $value['name'];
                        $id = $value['id'];
                        $html .= $name;
                        //print_r($value);
                        if(is_array($value['child'])) {
                                $html .= treeview($value['child'],$depth+1);
                                //$aaa[] = $value;
                        }
                        $html .= "</li>\n";
                }
        }
        $html .= "</ul>\n";
        return $html;
}
?>
