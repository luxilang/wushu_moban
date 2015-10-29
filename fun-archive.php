<?php
function echo_nav_list_info($post_type)
{
	
    $sticky = get_option( 'sticky_posts' );
    rsort( $sticky ); 
    $sticky = array_slice( $sticky, 0, 3 );
		$args = array( 
		  'post_type'=>$post_type,
		  'post_status'=>'publish',
		  'post__in'=>$sticky,
		/*
		  'meta_query'=>array(
		    array(
		      'key'=>'super-sticky',
		      'type'=>'NUMERIC',
		      'compare'=>'=',
		      'value'=>'1',
		    )
		  ),*/
		 // 'posts_per_page'=>10,
		  //'paged'=>1,
		  //'orderby'=>'date',
		 // 'order'=>'DESC'
		); 
	

	$the_query = new WP_Query($args);
	print_R($the_query);exit(); 
	
 
// 开始循环
if ( $the_query->have_posts() ) {//如果找到了结果，便输出以下内容
        echo '<ul>';
	while ( $the_query->have_posts() ) {//再次判断是否有结果
		$the_query->the_post();//不用问为什么，每次都要写这个；
	
		$img_url = get_post_meta(get_the_ID(),'_id_upload',true);
		
		?>
		<li>
		<?php echo get_the_title();  ?>
		
		<img  src="<?php echo $img_url ?>" />
		
		<div> <?php echo get_the_excerpt() ?></div>
		</li>
		<?php 

	}
        echo '</ul>';
} else {
	// 如果没有找到任何结果，就输出这个
}
 
wp_reset_postdata();//不用问为什么，每次都记得写就好


}
?>