<?php


 		?>

 		<br />
    <?php 
			echo $content = get_post('211')->post_content;   
			
			echo '<br />';
			
			/***
			$terms = get_terms('teachers_type', 'orderby=name&hide_empty=0&parent=0' ); 	
			
			$terms_arr = array();
			foreach ($terms as $value) {
				$terms_arr[$value->name] = $value->slug;
			}*/
			//var_export($terms_arr);
			$lei = !empty($_GET['lei']) ?  strip_tags($_GET['lei']) : ''; 
			$menu_arr = array (
			  '全部教练员' => '',
			  '太极拳教练员' => 'jl_taijiquan',
			  '散打教练员' => 'jl_sd',
			  '武术教练员' => 'jl_wush',
			  '空翻教练员' => 'jl_kongfan',
			  '跆拳道教练员' => 'jl_taiquandao',
			);

			foreach ($menu_arr as $key=> $value) {
 			
				$lei_url = '';
				if (!empty($value)) {
					$lei_url = "&lei={$value}";
				}
				?>
 							<a href="?post_type=teachers<?php echo $lei_url ?>"><?php echo $key ?></a> 
 							|
 				
 				
 			<?php 
 			}
 		

			$args['post_type'] = 'teachers';
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
			
			
	
			$query = new WP_Query( $args );
			
			
			
 			if (!empty($query->posts)) {
					$rs = $query->posts;
					foreach ($rs as $rs_o) {
							$img_url = get_post_meta($rs_o->ID,'_id_upload_teachers',true);
						?>
						
	
			<li>
		标题：<?php echo $rs_o->post_title;  ?> <br />
		描述：<?php echo $rs_o->post_content;  ?> <br />
		摘要：<?php echo $rs_o->post_excerpt;  ?> <br />
		图片<img  src="<?php echo $img_url ?>" width="200" height="200"    />
		<a href="<?php echo get_permalink($rs_o->ID); ?>">查看详细</a>   
		<hr />
		</li>			
						
						
						
						<?php 
						
						
						
					}
					
					
				}
				
				wp_reset_postdata();
    
    
    ?>
    

