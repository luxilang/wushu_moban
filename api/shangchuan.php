<?php
// 上传数据接口    0 失败 1 成功;
ini_set ( 'memory_limit', '3232M' );
set_time_limit ( 0 );
error_reporting ( 0 );
date_default_timezone_set ( 'Asia/Shanghai' );
require_once "class_fun.php";

$tip = 0;

du_log ( '--------start------------' );
$uploaddir = dirname ( __FILE__ ) . '/save_temp/'; //a directory inside 
$file_name = $_FILES ['fff'] ['name']  ;
$filename_arr  = pathinfo($file_name);
$upzip_dirname = $filename_arr['filename'];
du_log ( '--------'.$file_name.'------------' );
$is_up = move_uploaded_file ( $_FILES ['fff'] ['tmp_name'], $uploaddir . $file_name );
if ($is_up) {
	du_log ( 'upload success' );
} else {
	du_log ( 'upload fail' );
}

$zipfile = $uploaddir . $file_name;

chmod ( $zipfile, 0777 );
$savepath = dirname ( __FILE__ ) . "/save/";
$savepath = realpath ( $savepath );


if (zip_extract ( $zipfile, $savepath )) {
	du_log ( 'unzip success' );
} else {
	du_log ( 'unzip fail' );
}

$all_dir = fetchDir ( $savepath.'/'.$upzip_dirname.'/' );

$all_dir_real = array ();
if (!empty ( $all_dir )) {
	$all_dir_real = array_filter ( $all_dir  );
}

$all_dir_arr = array ();
$c_time = time ();

$droot = dirname ( dirname ( __FILE__ ) );
$droot = str_replace ( '\\', '/', $droot ) . '/';
foreach ( $all_dir_real as $key => $value ) {
	
	$value = realpath ( $value );
	$value = str_replace ( '\\', '/', $value );
	$value = str_replace ( $droot, '', $value );
	$all_dir_arr [] = array ($value, $c_time );
}
if (! empty ( $all_dir_arr )) {
	$fields = array ('file_path', 'create_date' );
	$insert_sql = insert ( 'wordpress_wushu', 'wp_article', $fields, $all_dir_arr ) . 'ON DUPLICATE KEY UPDATE file_path=VALUES(file_path)';
	
	require_once "cls_mysql.php";
	$mysql_db = new cls_mysql ( '127.0.0.1', 'root', '', 'wordpress_wushu' );
	
	$mysql_db->query ( 'SET NAMES GBK' );
	$mysql_db->query ( $insert_sql );
}

$tip = 1;
du_log ( '--------end------------' );
echo $tip;


