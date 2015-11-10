<?php


$terms = get_terms('class_time_type', 'orderby=name&hide_empty=0&parent=0' );  
if (empty($terms[0]))  die('error 0');
$terms_one = $terms[0];

$lei = !empty($_GET['lei']) ?  strip_tags($_GET['lei']) : $terms_one->slug; 
$url_bs = '?post_type=class_time';

foreach ($terms as $term) 
{
				$lei_url = '';
				if (!empty($term->slug)) 
				{
					$lei_url = "&lei={$term->slug}";
				}
				
					
			 $activ_sel = ($lei== trim($term->slug)) ? 'style="background:#F00; color:#FFF"' : '';
				
								
	 ?>
    
	 <a <?php echo  $activ_sel ?> href="<?php echo $url_bs.$lei_url ?>">

	 
	 <?php echo $term->name ?>
	 

	 </a> 


	 <?php 
	
}
?>
<br />
<?php


			$args['post_type'] = 'class_time';
			if (!empty($lei)) {
				
				$args['tax_query'] =  array(
				        'relation' => 'AND',
				        array(
				            'taxonomy' => 'class_time_type',
				            'field'    => 'slug',
				            'terms'    => array( "$lei"),
				        ),
				);
			}
			
			
	
			$query = new WP_Query( $args );
			
			if (!empty($query->posts)) {
				
					$rs = $query->posts;
					foreach ($rs as $rs_o) {
						
						echo $rs_o->post_content."<br />";
					}
			}
			wp_reset_postdata();