<?php

date_default_timezone_set ( "Asia/Shanghai" );
require_once "../wp-config.php";
if(empty($_GET['id']))  die('error id');
$id = $_GET['id'];

require_once "cls_mysql.php";
$mysql_db = new cls_mysql ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
$wp_title_file= $mysql_db->getRow("select * from wp_title_file where id = {$id} and is_qi = 0 ");
if (empty($wp_title_file)) {
	echo  ( '已经导入过了 或者 没有数据！ ' );
	echo '<a href="titledao.php">返回</a>';
	exit();
}
$title_file_path = $wp_title_file['title_file_path'];
$title_file_type = $wp_title_file['file_type'];
require_once "class_fun.php";
$droot = str_replace ( '\\', '/', ((dirname ( dirname ( __FILE__ ) ))) );
$uploadfile = $droot . '/api/save_title/'.$title_file_path;
if (! file_exists ( $uploadfile )) {
	
	echo  ( '没有文件！ ' );
	echo '<a href="titledao.php">返回</a>';
	exit();
}

$file = fopen ( $uploadfile, "r" );
$info = array ();
$i = 0;
//输出文本中所有的行，直到文件结束为止。
while ( ! feof ( $file ) ) {
	$info [$i] = fgets ( $file ); //fgets()函数从文件指针中读取一行
	$i ++;
}
fclose ( $file );
$info = array_filter ( $info );



$mysql_db->query ( 'SET NAMES GBK' );
$curr_time = date ( 'Y-m-d H:i:s' );
$curr_time_gmt = date ( 'Y-m-d H:i:s', time () - 8 * 3600 );
$cont_type = 'post';

if (! empty ( $info )) {
	$fields = array ();
	foreach ( $info as $k => $value ) {
		
		$cont_title = mb_substr ( $value, 0, 50 );
		$cont_content = $cont_title;
		$cont_excerpt = $cont_title;
		$fields = array (
			 'post_author' => '1', //管理员
			 'post_date' => $curr_time, 
			 'post_date_gmt' => $curr_time_gmt,
			 'post_content' => $cont_content,
			 'post_title' => $cont_title,
			 'post_excerpt' => $cont_excerpt,
			 'post_status' => 'publish',
			 'comment_status' => 'closed',
			 'ping_status' => 'closed',
			 'post_password' => '',
			 'post_name' => $cont_title,
			 'to_ping' => '',
			 'pinged' => '',
			 'post_modified' => $curr_time,
			 'post_modified_gmt' => $curr_time_gmt,
			 'post_content_filtered' => '',
			 'post_parent' => '',
			 'guid' => '',
			 'menu_order' => '0',
			 'post_type' => $cont_type,
			 'post_mime_type' => '',
			 'comment_count' => '0',
			 'title_type'=> $title_file_type,
			 
		);
		$mysql_db->autoExecute ( 'wp_posts', $fields );
	}
	
	
	$title_file_fields['is_qi'] = 1;
	$mysql_db->autoExecute ( 'wp_title_file', $title_file_fields,'UPDATE' ," id = {$id} " );
	//unlink ( $uploadfile );
	echo '导入成功！ <br />';
	echo '<a href="titledao.php">返回</a>';
} else {
	echo '没有数据！或者已经导入';
	echo '<a href="titledao.php">返回</a>';
}

