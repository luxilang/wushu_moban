<?php
if (!empty($_POST['ajax_type'])) 
{
		if ($_POST['ajax_type']  == 'post') {
								
				 $jiazai_tp = strip_tags($_POST['jiazai_tp']);
			 	 $lei = strip_tags($_POST['jiazai_lei']);
				 $lei1 = strip_tags($_POST['jiazai_lei1']);
				 $page = strip_tags($_POST['jiazai_page']);
				 
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
					$args['post_type'] = $jiazai_tp;
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
					$args['post_type'] = 'class_env';
					
					if (!empty($lei)) {
				
						$args['tax_query'] =  array(
								'relation' => 'AND',
								array(
									'taxonomy' => 'class_env_type',
									'field'    => 'slug',
									'terms'    => array( "$lei"),
								),
						);
					}
					
					$query = new WP_Query( $args );
					$rs_arr = array();
					$rs_arr['page'] = $jiazai_page;
	
					$rs_arr['rs'] = array();
					if (!empty($query->posts)) {
						
							$rs = $query->posts;
							
							foreach ($rs as $rs_o) {
								$img_url = get_post_meta($rs_o->ID,'_id_upload_env',true);
									$rs_arr['rs'][]= array(
										'id'=>$rs_o->ID,
										'title'=>$rs_o->post_title,
										'img_url'=>$img_url,
										'permalink'=>get_permalink($rs_o->ID),
									);		  
							}
					}
					wp_reset_postdata();
		  
					echo   json_encode($rs_arr);
					exit();
				}
				 
				 
				 
				 
				 
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
					if (!empty($lei)) {
						if ($jiazai_tp == 'teachers') {
								$taxonomy_type = 'teachers_type';
						}
						
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
		}elseif ($_POST['ajax_type']  == 'single'){
			
				
			
		}
}

if($_GET['ajax'] == 'single')
{

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
	$in_good= $wpdb->insert( 'wp_yuyue', $in) ;
	
	//打短信
	
	if($in_good)
	{
		echo 1;	
	}
	//$wpdb->insert_id
	//$wpdb->insert( 'table', array( 'column1' => 'value1', 'column2' => 123 ), array( '%s', '%d' ) ) 
	exit();
} 

?>