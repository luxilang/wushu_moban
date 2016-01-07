<?php
//定时更新发布
date_default_timezone_set('Asia/Shanghai');
require_once "cls_mysql.php";
$mysql_db = new cls_mysql ('127.0.0.1','root','', 'wordpress_wushu' );
//$mysql_db->query('SET NAMES GBK');	

$sql = "SELECT COUNT(*) AS num FROM wp_posts WHERE  post_status = 'publish'  AND  post_type = 'post' AND  flag = 0 ";
$title_num =  $mysql_db->getOne($sql);
$sql = "SELECT COUNT(*) AS num FROM wp_article  WHERE  flag = 0 AND  title_id = 0";
$sp_article_num =  $mysql_db->getOne($sql); 

if ($sp_article_num >0 && $title_num > 0) { //发布
	
	$time = date("Y-m-d H:i:s");
	$time_z = date('Y-m-d H:i:s',time()-8*3600);
	$create_date = time();
	$sql = "SELECT * FROM wp_posts WHERE  id >=(SELECT MIN(ID) FROM wp_posts WHERE  post_status = 'publish'  AND  post_type = 'post' AND  flag = 0)  ";
	$title_rs =  $mysql_db->getAll($sql);
	$title_id_arr = array();
	foreach ($title_rs as $value) {
		$title_id_arr[] = $value['ID'];
	}
	
	$sql = "SELECT MIN(id) FROM wp_article  WHERE  flag = 0 AND  title_id = 0";
	$article_minid =  $mysql_db->getOne($sql);
	
	
	$sql = "SELECT * FROM wp_article  WHERE  id >= {$article_minid}   LIMIT  {$title_num} ";
	$article =  $mysql_db->getAll($sql);
	
	foreach ($article as $key => $value) {
		$title_id = $title_id_arr[$key];
		$sql ="UPDATE wp_article SET  title_id = {$title_id} ,flag = 1,create_date= '{$create_date}'  WHERE id = {$value['id']}";
		$mysql_db->query($sql);
	}
	
	foreach ($title_rs as $value) {
		$sql ="UPDATE wp_posts SET  flag = 1,post_date='{$time}',post_date_gmt='{$time_z}'  WHERE ID = {$value['ID']}";
		$mysql_db->query($sql);
	}
	
}else{
	echo '0';
}
file_put_contents('logfile1.log', date("Y-m-d H:i:s"). " " . 'zhixing'.PHP_EOL, FILE_APPEND | LOCK_EX);