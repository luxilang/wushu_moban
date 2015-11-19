<?php
class lu_ajax {
	function __construct() {
		header("Content-type: text/html; charset=utf-8");
		if (!empty($_GET['ajax'])) 
		{
				
				 $p['post_type'] = strip_tags($_GET['jiazai_tp']);
				switch ( $p['post_type']) {
					case 'teachers':
					
					 $p['lei'] = strip_tags($_GET['jiazai_lei']);
					 $p['page'] = strip_tags($_GET['jiazai_page']);
					 $this->teachers($p);
					break;
					case 'students':
					 $p['lei'] = strip_tags($_GET['jiazai_lei']);
					 $p['lei1'] = strip_tags($_GET['jiazai_lei1']);
					 $p['page'] = strip_tags($_GET['jiazai_page']);
					 $this->students($p);
					break;

					default:
						;
					break;
				}
			
			
			exit();
		}
		
	}
	function students($p){
		/*
		$page_number = 3;

		$args['posts_per_page'] = $page_number;
		
		if (empty($p['page'])) {
			$position = 0; 
			$jiazai_page = 1;
		}else{
			$position = ($page_number * $p['page']); 
			$jiazai_page = $p['page']+1; 
		}

		$args['offset'] = $position;
		
		*/
		global $wpdb;
		$lei = trim($p['lei']);
		$lei1 = trim($p['lei1']);
		$args = array();
		$args['post_type'] = 'students';
		$args['tax_query']['relation'] = 'AND';
		
		
		
			array_push($args['tax_query'], array(
						'taxonomy' => 'students_type',
						'field'    => 'slug',
						'terms'    => array( " feng1"),
			));
			
	
	
				array_push($args['tax_query'], array(
						'taxonomy' => 'students_type1',
						'field'    => 'slug',
						'terms'    => array( "xueyuan_xlhx"),
			));
		
	
		
		$query = new WP_Query( $args );
		
		print_R($query);
		wp_reset_postdata();
		exit();
		
		
		$lei = $p['lei'];
		$lei1 = $p['lei1'];
					
		$args['post_type'] = 'students';
		$args['tax_query']['relation'] = 'AND';
		
	
		if (!empty($lei)) {
			array_push($args['tax_query'], array(
						'taxonomy' => 'students_type',
						'field'    => 'slug',
						'terms'    => array( "$lei"),
			));
		}
		
		if (!empty($lei1)) {
				array_push($args['tax_query'], array(
						'taxonomy' => 'students_type1',
						'field'    => 'slug',
						'terms'    => array( "$lei1"),
			));
		
		}
		
		$rs_arr = array();
		$rs_arr['page'] = $jiazai_page;
		$rs_arr['rs'] = array();
		//print_R( $args);
		$query = new WP_Query( $args );
		print_R( $query);	exit();		
		if (!empty($query->posts)) {
				$rs = $query->posts;
				foreach ($rs as $rs_o) {
						$img_url = get_post_meta($rs_o->ID,'_id_upload_teachers',true);
						$rs_arr['rs'][]= array(
							'title'=>$rs_o->post_title(),
							'img_url'=>$img_url,
							'permalink'=>get_permalink($rs_o->ID),
						);							}
		
		}
		wp_reset_postdata();

		echo   json_encode($rs_arr,true);
	}
	function teachers($p) {
		$page_number = 3;
		
		$lei = $p['lei'];
		$args['post_type'] =  $p['post_type'];
		$args['posts_per_page'] = $page_number;
		
		if (empty($p['page'])) {
			$position = 0; 
			$jiazai_page = 1;
		}else{
			$position = ($page_number * $p['page']); 
			$jiazai_page = $p['page']+1; 
		}
		
		$args['offset'] = $position;
	
		if (!empty($lei)) {
			
			$args['tax_query'] =  array(
			        'relation' => 'AND',
			        array(
			            'taxonomy' => 'teachers_type',
			            'field'    => 'slug',
			            'terms'    => array( "$lei"),
			        ),
			);
			
		}
		
	
		
		$the_query = new WP_Query( $args );
		
		$rs_arr = array();
		$rs_arr['page'] = $jiazai_page;
		$rs_arr['rs'] = array();
		if ( $the_query->have_posts() ) {
		
				while ( $the_query->have_posts() ) {
					
						
					$the_query->the_post();
					$img_url = get_post_meta(get_the_ID(),'_id_upload_teachers',true);
					$rs_arr['rs'][]= array(
						'title'=>get_the_title(),
						'excerpt'=>get_the_excerpt(),
						'img_url'=>$img_url,
						'permalink'=>get_permalink(get_the_ID()),
					);
	
				
				}
			
		} else {
			
		}
			
		wp_reset_postdata();
		
		echo   json_encode($rs_arr,true);

	}
}	

$lu_ajax = new lu_ajax();