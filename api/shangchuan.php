<?php
// 上传数据接口    0 失败 1 成功;
ini_set ( 'memory_limit', '3232M' );
set_time_limit ( 0 );
error_reporting ( 0 );
date_default_timezone_set ( 'Asia/Shanghai' );
require_once "class_fun.php";
function createFolder($path) {
		if (!file_exists($path)) {
			createFolder(dirname($path));
			mkdir($path, 0777);
		}
}

$log_file = 'shangchuan.log';
$tip = 0;

du_log ( $log_file,'--------start------------' );
$uploaddir = dirname ( __FILE__ ) . '/save_temp/'; //a directory inside 
$file_name = $_FILES ['fff'] ['name']  ;
$filename_arr  = pathinfo($file_name);

du_log ( $log_file,'--------'.$file_name.'------------' );
$time_tag = date('YmdHis') . rand(0, 9999);

$upzip_dirname =  $filename_arr['filename'];

$new_ming = $filename_arr['filename'].'_'.$time_tag;
$file_name_news = $new_ming.'.'.$filename_arr['extension'];

$is_up = move_uploaded_file ( $_FILES ['fff'] ['tmp_name'], $uploaddir . $file_name_news );
if ($is_up) {
	du_log ($log_file, 'upload success' );
} else {
	du_log ($log_file, 'upload fail' );
}

$zipfile = $uploaddir . $file_name_news;

chmod ( $zipfile, 0777 );
$savepath = dirname ( __FILE__ ) . "/save/".$time_tag.'/';
createFolder($savepath);
$savepath = realpath ( $savepath );


if (zip_extract ( $zipfile, $savepath )) {
	du_log ($log_file, 'unzip success' );
} else {
	du_log ($log_file, 'unzip fail' );
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

$fields = array ('file_path', 'create_date' );


if (! empty ( $all_dir_arr )) {
	$fields = array ('file_path', 'create_date' );
	
	$DB_NAME = 'wordpress_wushu';;
	$DB_USER = 'root';
	$DB_PASSWORD = '';
	$DB_HOST = '127.0.0.1';
	
	$insert_sql = insert ( $DB_NAME, 'wp_article', $fields, $all_dir_arr ) . 'ON DUPLICATE KEY UPDATE file_path=VALUES(file_path)';
	//$insert_sql = insert ( 'wordpress_wushu', 'wp_article', $fields, $all_dir_arr ) ;
	define('DB_NAME', 'wordpress_wushu');

	//du_log ($log_file, $insert_sql );
	require_once "cls_mysql.php";
	$mysql_db = new cls_mysql ( $DB_HOST, $DB_USER,$DB_PASSWORD, $DB_NAME );
	
	$mysql_db->query ( 'SET NAMES GBK' );
	$mysql_db->query ( $insert_sql );
}

$tip = 1;
du_log ( $log_file, '--------end------------' );
echo $tip;


