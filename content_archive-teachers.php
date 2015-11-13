<?php
		$post_type = get_post_type();

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
			
			$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<ul>';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$img_url = get_post_meta(get_the_ID(),'_id_upload_teachers',true);
		?>
		 
		<li>
		标题：<?php the_title();  ?> <br />
		标题：<?php the_content();  ?> <br />
		摘要：<?php the_excerpt();  ?> <br />
		标题：<?php get_permalink();  ?> <br />
			图片<img  src="<?php echo $img_url ?>" width="200" height="200"    />
		<a href="<?php echo get_permalink(get_the_ID()); ?>">查看详细</a>   
		 </li>
		<?php 
		
	}
	echo '</ul>';
} else {
	// no posts found
}
/* Restore original Post Data */
wp_reset_postdata();
			
 	
    

