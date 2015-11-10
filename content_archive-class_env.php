<?php

$terms = get_terms('class_env_type', 'orderby=name&hide_empty=0&parent=0' );  
if (empty($terms[0]))  die('error 0');
$terms_one = $terms[0];

$lei = !empty($_GET['lei']) ?  strip_tags($_GET['lei']) : $terms_one->slug; 
$url_bs = '?post_type=class_env';



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
			
			if (!empty($query->posts)) {
					$rs = $query->posts;
					foreach ($rs as $rs_o) {
							$img_url = get_post_meta($rs_o->ID,'_id_upload_env',true);
						?>
						图片<img  src="<?php echo $img_url ?>" width="200" height="200"    />
						<?php 
					}
			}
			wp_reset_postdata();