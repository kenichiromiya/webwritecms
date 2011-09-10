<?php

function getDirectoryTree( $outerDir ){ 
    $dirs = array_diff( scandir( $outerDir ), Array( ".", ".." ) ); 
    $dir_array = Array(); 
    foreach( $dirs as $d ){ 
        if( is_dir($outerDir."/".$d) ) $dir_array[ $d ] = getDirectoryTree( $outerDir."/".$d ); 
        else $dir_array[ $d ] = $d; 
    } 
    return $dir_array; 
} 

function getpagenation($option) {
	$cur_page = $option['cur_page'];
	$per_page = $option['per_page'];
	$total_rows = $option['total_rows'];
	$cur_page = isset($cur_page) ? $cur_page : '1';

	$min_page = 1;
	$max_page = ceil($total_rows/$per_page);
	$pagenation = array();
	$pages = array($cur_page);
	$offset = 1;
	while ($count < 5 and (($cur_page - $offset > 0) or ($cur_page + $offset <= $max_page))) {
		if ($cur_page - $offset > 0 ){
			array_unshift($pages,$cur_page - $offset);
			$count++;
		}
		if ($cur_page + $offset <= $max_page ){
			array_push($pages,$cur_page + $offset);
			$count++;
		}
		$offset++;
	}

	$url = $_ENV["REQUEST_URI"];
	$parsed_url =  parse_url($url);
	$dirname = dirname($parsed_url['path']);
	$path = preg_replace("/p\d+\/$/","",$parsed_url['path']);

	//$start_page = array_shift($pages);
	//$end_page = array_pop($pages);
	$start_page = $pages[0];
	$end_page = $pages[count($pages)-1];

	for ($i = $start_page;$i <= $end_page;$i++) {
		$pagenation['pages'][$i]['num'] = $i;
		if ($i != $cur_page) {
			$pagenation['pages'][$i]['query'] = $parsed_url['query'];
			$pagenation['pages'][$i]['url'] = "http://".$_SERVER['HTTP_HOST'].$path."p$i/?".$parsed_url['query'];
		}
	}

	$pagenation['min_page']['num'] = 1;
	$parsed_query['p'] = 1;
	$pagenation['min_page'] = http_build_query($parsed_query);
	if($cur_page > $min_page){
		$i = $cur_page-1;
		$pagenation['prev_page']['query'] = $parsed_url['query'];
		$pagenation['prev_page']['url'] = "http://".$_SERVER['HTTP_HOST'].$path."p$i/?".$parsed_url['query'];
	}
	if($cur_page < $max_page){
		$i = $cur_page+1;
		$pagenation['next_page']['query'] = http_build_query($parsed_query);
		$pagenation['next_page']['url'] = "http://".$_SERVER['HTTP_HOST'].$path."p$i/?".$parsed_url['query'];
	}
	$pagenation['max_page']['num'] = $max_page;
	$i = $max_page;
	$pagenation['max_page']['query'] = http_build_query($parsed_query);
	$pagenation['max_page']['url'] = "http://".$_SERVER['HTTP_HOST'].$path."p$i/?".$parsed_url['query'];
	return $pagenation;
}

//WHERE photo.photo_id = tag.photo_id and tag.tagname = '$query'"


function getpath() {
	
	$parseurl = parse_url("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	$path = explode('/', $parseurl['path']); 

	return $path;
}


function getdone() {
	return urlencode("http://".$_ENV["HTTP_HOST"].$_ENV["REQUEST_URI"]);
}

function getresampledimagesize($filename,$max_width,$max_height) {
	list($width, $height,$imagetype) = getimagesize($filename);

	$ratio = $width/$height;

	if ($ratio > 1) {
		$new_width = $max_width;
		$new_height = $max_height/$ratio;
	} else {
		$new_width = $max_width*$ratio;
		$new_height = $max_height;
	}
	return array($new_width,$new_height);
} 

function imageresize($newfilename,$filename,$max_width,$max_height) {
	// 新規サイズを取得します
	list($width, $height,$imagetype) = getimagesize($filename);

	$ratio = $width/$height;

	if ($ratio > 1) {
		$new_width = $max_width;
		$new_height = $max_width/$ratio;
	} else {
		$new_width = $max_height*$ratio;
		$new_height = $max_height;
	}

	//$new_width = $max_width;
	//$new_height = $max_height/$ratio;

	// 再サンプル
	$image_p = imagecreatetruecolor($new_width, $new_height);
	switch ($imagetype)
	{
		case 1:
			$image = imagecreatefromgif($filename);
			break;
		case 2:
			$image = imagecreatefromjpeg($filename);
			break;
		case 3:
			$image = imagecreatefrompng($filename);
			break;
	}
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
//$matrix = array(array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1));   
//imageconvolution($image_p, $matrix, 8, 0);   
  

// 出力
	if (preg_match("/jpg/",$newfilename,$m)) {
		imagejpeg($image_p, $newfilename, 95);
	}
	if (preg_match("/gif/",$newfilename,$m)) {
		imagegif($image_p, $newfilename);
	}
	if (preg_match("/png/",$newfilename,$m)) {
		imagepng($image_p, $newfilename);
	}
}

# PHP Calendar (version 2.3), written by Keith Devens
# http://keithdevens.com/software/php_calendar
#  see example at http://keithdevens.com/weblog
# License: http://keithdevens.com/software/license


//http://www.php-z.net/c10/n84.html
function list_to_tree($category = array(),
		$idField = 'id',$parentField='parent_id'){
	if(!is_array($category)) exit("配列ではありません");

	$index = array();
	$tree = array();

	foreach($category as $value){
		$id     = $value[$idField];
		$parent = $value[$parentField];

		if(isset($index[$id])){
			$value['child'] = $index[$id]['child'];
			$index[$id] = $value;

		} else {
			$index[$id] = $value;
		}

		if($parent == 0){
			$tree[] =& $index[$id];

		} else {
			$index[$parent]['child'][] =& $index[$id];
		}


	}
	return $tree;
}


function tree_walk($data=array(),$callback){

	if(is_array($data)){
		foreach($data as $key => $value){
			$callback($value);
			if(is_array($value['child'])) {
				tree_walk($value['child']);
			}
		}
	}
}
?>
