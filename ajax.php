<?php

if (!empty($_POST['ajax_type'])) 
{
		if ($_POST['ajax_type']  == 'post') {
								
				 $jiazai_tp = strip_tags($_POST['jiazai_tp']);
			 	 $lei = strip_tags($_POST['jiazai_lei']);
				 $lei1 = strip_tags($_POST['jiazai_lei1']);
				 $page = strip_tags($_POST['jiazai_page']);
				 
				 //学员风采
				 if ($jiazai_tp == 'students' ) {
				 	
					$page_number = 3;

					if (empty($page)) {
						$position = 0; 
						$jiazai_page = 1;
					}else{
						$position = ($page_number * $page); 
						$jiazai_page = $page+1; 
					}
					
				 	
				 	$curr_gid = $lei;
				 	$curr_tag_str = $lei1;
				 	
				 	$sql = "
					SELECT wp_ngg_gallery.name AS dirname,wp_ngg_pictures.* FROM  wp_ngg_pictures 
					LEFT JOIN wp_ngg_gallery ON  wp_ngg_gallery.gid = wp_ngg_pictures.galleryid
					LEFT JOIN  
					wp_term_relationships  ON 
					wp_term_relationships.object_id  = wp_ngg_pictures.pid
					LEFT JOIN
					wp_term_taxonomy
					ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
					LEFT JOIN 
					wp_terms 
					ON  wp_terms.term_id = wp_term_taxonomy.term_id
					
					WHERE wp_term_taxonomy.taxonomy = 'ngg_tag'  AND wp_terms.name = '{$curr_tag_str}'  AND wp_ngg_pictures.galleryid = '{$curr_gid}'  limit {$position},{$page_number}
				 	";
				 	
				 	$pictures = $wpdb->get_results($sql);
				 	$rs_arr = array();
					$rs_arr['page'] = $jiazai_page;
					$rs_arr['rs'] = array();
					
				 	foreach ($pictures as $picture) {
						$img_url = "/wp-content/gallery/".$picture->dirname."/".$picture->filename;
						$img_url_r = "/wp-content/gallery/".$picture->dirname."/".$picture->filename;
						//$img_thumbs = "/wp-content/gallery/".$picture->dirname."/thumbs/thumbs_".$picture->filename;
						$img_thumbs = site_url()."/wp-content/uploads/timthumb.php?src=".site_url().$img_url."&w=274&h=370".get_timthumb_cf();
						$rs_arr['rs'][]= array(
							'id'=>$picture->pid,
							'title'=>$picture->alttext,
							'img_url'=>$img_url,
							'img_url_r'=>($img_url_r == '') ? $img_url : $img_url_r,
							'img_thumbs'=>$img_thumbs
						);	
				 	}
			
				 	echo   json_encode($rs_arr);
				 	exit();
				 }
				 
				 
				 //费用
				if ($jiazai_tp == 'class_fee' ) 
				{
				  	$page_number = 4;
					$args['posts_per_page'] = $page_number;
					if (empty($page)) {
						$position = 0; 
						$jiazai_page = 1;
					}else{
						$position = ($page_number * $page); 
						$jiazai_page = $page+1; 
					}
					$args['offset'] = $position;
					
					$args['post_type'] = 'class_fee';
					if (!empty($lei)) {
						if($lei == 'tao0'){
										
										function objectToArray($e){
											$e=(array)$e;
											foreach($e as $k=>$v){
												if( gettype($v)=='resource' ) return;
												if( gettype($v)=='object' || gettype($v)=='array' )
													$e[$k]=(array)objectToArray($v);
											}
											return $e;
										}
								
										$terms = get_terms('class_fee_type', 'orderby=name&hide_empty=0&parent=0' );
										$terms = objectToArray($terms);
										
										$all_ids = array();
										foreach ($terms as $term) 
										{		
												if(!empty($term['term_id']))
												{
													$all_ids[] = $term['term_id'];
												}
										}
							
							
							
							
							$args['tax_query'] =  array(
									'relation' => 'AND',
									array(
										'taxonomy' => 'class_fee_type',
										'field'    => 'id',
										'terms'    => $all_ids,
									),
							);
						}else{
							$args['tax_query'] =  array(
									'relation' => 'AND',
									array(
										'taxonomy' => 'class_fee_type',
										'field'    => 'slug',
										'terms'    => array( "$lei"),
									),
							);
						}	
		
					}
					
					
					
					$query = new WP_Query( $args );
					$rs_arr = array();
					$rs_arr['page'] = $jiazai_page;
	
					$rs_arr['rs'] = array();
					if (!empty($query->posts)) {
						
							$rs = $query->posts;
							
							foreach ($rs as $rs_o) {
								 $rs_arr['rs'][]= array(
											'id'=>$rs_o->ID,
											'title'=>$rs_o->post_title,
											'content'=>$rs_o->post_content,
											
										);	  
							}
					}
					wp_reset_postdata();
		  
					echo   json_encode($rs_arr);
					exit();
				}
				 //环境
				if ($jiazai_tp == 'class_env' ) 
				{
					$page_number = 3;

					if (empty($page)) {
						$position = 0; 
						$jiazai_page = 1;
					}else{
						$position = ($page_number * $page); 
						$jiazai_page = $page+1; 
					}
					
				 	
				 	$curr_gid = $lei;
				 	

				 	$sql = "
					SELECT wp_ngg_gallery.name AS dirname,wp_ngg_pictures.* FROM  wp_ngg_pictures 
					LEFT JOIN wp_ngg_gallery ON  wp_ngg_gallery.gid = wp_ngg_pictures.galleryid
					WHERE  wp_ngg_pictures.galleryid = '{$curr_gid}'  limit {$position},{$page_number}
				 	";

				 	$pictures = $wpdb->get_results($sql);
				 	$rs_arr = array();
					$rs_arr['page'] = $jiazai_page;
					$rs_arr['rs'] = array();
					
				 	foreach ($pictures as $picture) {
						$img_url = "/wp-content/gallery/".$picture->dirname."/".$picture->filename;
						$img_url_r = "/wp-content/gallery/".$picture->dirname."/".$picture->filename;
						//$img_thumbs = "/wp-content/gallery/".$picture->dirname."/thumbs/thumbs_".$picture->filename;
						$img_thumbs = site_url()."/wp-content/uploads/timthumb.php?src=".site_url().$img_url."&w=274&h=220".get_timthumb_cf();
						$rs_arr['rs'][]= array(
							'id'=>$picture->pid,
							'title'=>$picture->alttext,
							'img_url'=>$img_url,
							'img_url_r'=>($img_url_r == '') ? $img_url : $img_url_r,
							'img_thumbs'=>$img_thumbs
						);	
				 	}
			
				 	echo   json_encode($rs_arr);
					exit();
				}
				 
				 
				 if ($jiazai_tp == 'teachers') {
				 
				 
				 $page_number = 3;
				 if ($jiazai_tp == 'students' || $jiazai_tp == 'teachers') 
				 {
				 	$page_number = 3;
				 }
			
				$args['posts_per_page'] = $page_number;
				
				if (empty($page)) {
					$position = 0; 
					$jiazai_page = 1;
				}else{
					$position = ($page_number * $page); 
					$jiazai_page = $page+1; 
				}
				
				$args['offset'] = $position;
				$args['post_type'] = $jiazai_tp;
				if (!empty($lei) && !empty($lei1)) {

							if ($jiazai_tp == 'students') {
								$taxonomy_type_arr = array('students_type','students_type1');
							}
					
					 		$args['tax_query']['relation'] = 'AND';

							if (!empty($lei)) {
								array_push($args['tax_query'], array(
											'taxonomy' => $taxonomy_type_arr[0],
											'field'    => 'slug',
											'terms'    => array( "$lei"),
								));
								
							
							}
							
							if (!empty($lei1)) {
									array_push($args['tax_query'], array(
											'taxonomy' => $taxonomy_type_arr[1],
											'field'    => 'slug',
											'terms'    => array( "$lei1"),
								));
							
							}
		
				}else{
				
						if ($jiazai_tp == 'teachers') {
								$taxonomy_type = 'teachers_type';
						}
					if (!empty($lei)) {	
						$args['tax_query'] =  array(
						        'relation' => 'AND',
						        array(
						            'taxonomy' => $taxonomy_type,
						            'field'    => 'slug',
						            'terms'    => array( "$lei"),
						        ),
						);
					}
		 		}	
	
				
				$query = new WP_Query( $args );
				
				//print_R($query);
				$rs_arr = array();
				$rs_arr['page'] = $jiazai_page;

				$rs_arr['rs'] = array();
				if (!empty($query->posts)) {
						$rs = $query->posts;	
						foreach ($rs as $rs_o) {
							
								if($jiazai_tp == 'students')
								{
								
									$img_url = get_post_meta($rs_o->ID,'_id_upload_students',true);
									$img_url_r = get_post_meta($rs_o->ID,'_id_upload_students_real',true);
									$rs_arr['rs'][]= array(
										'id'=>$rs_o->ID,
										'title'=>$rs_o->post_title,
										'img_url'=>$img_url,
										'img_url_r'=>($img_url_r == '') ? $img_url : $img_url_r,
										
										'permalink'=>get_permalink($rs_o->ID),
									);	
								}elseif ($jiazai_tp == 'teachers'){
									$img_url = get_post_meta($rs_o->ID,'_id_upload_teachers',true);
									$img_url = site_url()."/wp-content/uploads/timthumb.php?src=".site_url().$img_url."&w=212&h=212".get_timthumb_cf();
									$rs_arr['rs'][]= array(
										'title'=>$rs_o->post_title,
										//'content'=>$rs_o->post_content,
										'img_url'=>$img_url,
										'permalink'=>get_permalink($rs_o->ID),
										'yddj'=>get_post_meta($rs_o->ID,'_teachers_yddj',true),
										'sewsjljy'=>get_post_meta($rs_o->ID,'_teachers_sewsjljy',true),
										'jxfg'=> get_post_meta($rs_o->ID,'_teachers_jxfg',true),
									);
								}						
						}
				
				}
				wp_reset_postdata();
		
				echo   json_encode($rs_arr);
				exit();
				
				
				}
				 
		}elseif ($_POST['ajax_type']  == 'single'){
			
				
			
		}
}

if($_GET['ajax'] == 'single')
{


 
//如果token为空则生成一个token 

 if(!valid_token()){ 
 	echo 4;exit();
 }else{ 

	$in['type_id'] =  intval($_POST['type_id']);
	$in['post_id'] = intval($_POST['post_id']);

	$in['xue_name'] = strip_tags($_POST['xue_name']);
	$in['xue_nian'] = strip_tags($_POST['xue_nian']);
	$in['jia_tel'] = strip_tags($_POST['jia_tel']);
	$in['xingbie'] = strip_tags($_POST['xingbie']);
	$in['xiaoqu'] = strip_tags($_POST['xiaoqu']);
	$in['yuyuetime'] = strip_tags($_POST['yuyuetime']);
	$in['quyu'] = strip_tags($_POST['quyu']);
	$in['beizhu'] = strip_tags($_POST['beizhu']);
	$in['ctime'] = date('Y-m-d H:i:s');
	
	
	$ashu_email_tel_arr = get_option('ashu_email_tel');
	array_map('trim', $ashu_email_tel_arr);
	//发邮件
	$send_mail = false;
	
	if (!empty($ashu_email_tel_arr['_auto_email'])) 
	{
		ini_set("magic_quotes_runtime",0);
		$auto_email_str = $ashu_email_tel_arr['_auto_email'];
		$auto_email_str = @str_replace('；', ';', $auto_email_str);
		$auto_email_arr  = array_filter(explode(";", $auto_email_str));
		//print_r($auto_email_arr);
		//exit();
		$auto_email_arr = array_map('trim', $auto_email_arr);
		if (!empty($auto_email_arr)) {
			foreach ($auto_email_arr as $auto_email) {
				try {
					$mail_cont = "免费试课提醒<br />
					学员：{$in['xue_name']}<br />
					年龄：{$in['xue_nian']}<br />
					联系方式:{$in['jia_tel']}<br />
					性别：{$in['xingbie']}<br/>
					最近的校区：{$in['xiaoqu']}<br/>
					想预约什么时间来体验：{$in['yuyuetime']}<br/>
					你所在的区域：{$in['quyu']}<br/>
					家长想让孩子学？还是孩子自己喜欢：{$in['beizhu']}<br/>
					";
					$mail = new PHPMailer(true); 
					$mail->IsSMTP();
					$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
					$mail->SMTPAuth   = true;                  //开启认证
					$mail->Port       = 25;                    
					$mail->Host       = "smtp.139.com"; 
					$mail->Username   = "devtest151210@139.com";    
					$mail->Password   = "test20151210dev";            
					//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
					$mail->AddReplyTo("devtest151210@139.com","武术世家");//回复地址
					$mail->From       = "devtest151210@139.com";
					$mail->FromName   = "devtest151210@139.com";
					$to = $auto_email;
					$mail->AddAddress($to);
					$mail->Subject  = "武术世家免费试课提醒信息";
					$mail->Body = $mail_cont;
					$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
					$mail->WordWrap   = 80; // 设置每行字符串的长度
					//$mail->AddAttachment("f:/test.png");  //可以添加附件
					$mail->IsHTML(true); 
					$mail->Send();
					//echo '邮件已发送';
					$send_mail =true;
				} catch (phpmailerException $e) {
					//$send_mail = false;
					//echo "邮件发送失败：".$e->errorMessage();
				}
				
				
			}
		}

	}	
	//发短信
	$send_sms = false;
		
	if (!empty($ashu_email_tel_arr['_auto_tel'])) 
	{
		$auto_tel_str = $ashu_email_tel_arr['_auto_tel'];
		
		$auto_tel_str = @str_replace('；', ';', $auto_tel_str);
		$auto_tel_arr  = array_filter(explode(";", $auto_tel_str));
		//print_r($auto_tel_arr);
		//exit();
		$auto_tel_arr = array_map('trim', $auto_tel_arr);
		$content_rs = "免费试课提醒，学员:{$in['xue_name']},年龄:{$in['xue_nian']},联系方式:{$in['jia_tel']}";
		$url_j = 'https://sms.yunpian.com/v1/sms/send.json';
		
		$tpl_id = '1264517';
		
		if (!empty($auto_tel_arr)) {
			foreach ($auto_tel_arr as $key => $auto_tel) {
				$jieshou_tel = $auto_tel;
			    $curl = new Curl();
		        $curl->ssl(false);
		
		        $result = $curl->simple_post($url_j, 
		
			        array('tpl_id'=>$tpl_id,
					'apikey'=>'e807d02ce3330c1de3c9ee02c8c54358',
					'mobile'=>$jieshou_tel,
			        'text'=>$content_rs,
			        )
		        );
		
		        $data = json_decode($result, true);
		        
		        if ($data['code'] == '0' && $data['msg'] == 'OK') {
		        	//$send_sms = true;
		        }
			}
		}
		
     
	}	
	
	/*
	if (!$send_mail) {
		echo 2;	
		exit();
	}
	if (!$send_sms) {
		echo 3;	
		exit();
	}*/
	$in_good= $wpdb->insert( 'wp_yuyue', $in) ;
	if($in_good)
	{
		echo 1;	
		exit();
	}
 }
	//$wpdb->insert_id
	//$wpdb->insert( 'table', array( 'column1' => 'value1', 'column2' => 123 ), array( '%s', '%d' ) ) 
	exit();
} 

?>