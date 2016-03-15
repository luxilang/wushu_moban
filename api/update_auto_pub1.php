<?php
//定时更新发布

date_default_timezone_set ( "Asia/Shanghai" );
require_once "../wp-config.php";
require_once "cls_mysql.php";
$mysql_db = new cls_mysql ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
//$mysql_db->query('SET NAMES GBK');	
	


	$rs =  $mysql_db->getAll('select * from wp_article1 WHERE  flag = 0  ');
	if (!empty($rs)) {
		
		foreach ($rs as $value) {

			$title_file_type = mt_rand(1, 6);
			$fubiaoti ='';
			$cont_file = $value['file_path'];
			$cont_file = dirname(dirname ( __FILE__ )) . "/".$cont_file;
			$cont_file_html =  file_get_contents($cont_file); 
			$cont_file_html = mb_convert_encoding($cont_file_html, "UTF-8", "GB2312");
			
			$fubiaoti_h1 ='';
			preg_match_all('/<h1.+?>(.*?)<\/h1>/si' ,$cont_file_html, $r_cont_file_html);
			if (!empty($r_cont_file_html[1][0])) {
				$fubiaoti_h1 = $r_cont_file_html[1][0];
			}
			
			$fubiaoti_h4 = '';
			preg_match_all('/<h4.+?>(.*?)<\/h4>/si' ,$cont_file_html, $r_cont_file_html);
			if (!empty($r_cont_file_html[1][0])) {
				$fubiaoti_h4 = $r_cont_file_html[1][0];
				
			}
			$fubiaoti_h4 = !empty($fubiaoti_h4) ? '-'.$fubiaoti_h4 : $fubiaoti_h4;
			$fubiaoti = $fubiaoti_h1.$fubiaoti_h4;

	
			if (!empty($fubiaoti)) {
					//3.从新文章 拆分标题到里面  post 中 并 切 更新 新文章  
					$cont_title = $fubiaoti;
					$curr_time = date ( 'Y-m-d H:i:s' );
					$curr_time_gmt = date ( 'Y-m-d H:i:s', time () - 8 * 3600 );
					$cont_content = $cont_title;
					$cont_excerpt = $cont_title;
					$cont_type = 'post';
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
						 'is_split_title'=> '1'
					);
					$mysql_db->autoExecute ( 'wp_posts', $fields );
			}
			$title_id = $mysql_db->insert_id();
			$create_date = time();
			$sql ="UPDATE wp_article1 SET  title_id = {$title_id} ,flag = 1,create_date= '{$create_date}'  WHERE id = {$value['id']}";
			$mysql_db->query($sql);
			
			$curr_time1 = date ( 'Y-m-d H:i:s' );
			$curr_time_gmt1 = date ( 'Y-m-d H:i:s', time () - 8 * 3600 );
			$sql ="UPDATE wp_posts SET  flag = 1,post_date='{$curr_time1}',post_date_gmt='{$curr_time_gmt1}'  WHERE ID = {$title_id} and is_split_title = 1";
			$mysql_db->query($sql);
			
		}
	}else{
		echo 'empty_data';
	}
file_put_contents('update_auto_pub1.log', date("Y-m-d H:i:s"). " " . 'gengxing'.PHP_EOL, FILE_APPEND | LOCK_EX);
