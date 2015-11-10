<br />
<?php

$terms = get_terms('students_type', 'orderby=id&hide_empty=0&parent=0' );
$terms1 = get_terms('students_type1', 'orderby=id&hide_empty=0&parent=0' );    
if (empty($terms[0]))  die('error 0');
if (empty($terms1[0]))  die('error 0');
$terms_one = $terms[0];
$terms_one1 = $terms1[0];
$lei = !empty($_GET['lei']) ?  strip_tags($_GET['lei']) : $terms_one->slug; 
$lei1 = !empty($_GET['lei1']) ?  strip_tags($_GET['lei1']) : $terms_one1->slug; 
$url_bs = '?post_type=students';

foreach ($terms as $term) 
{
				
		$lei_url = ''; if (!empty($term->slug))  $lei_url = "&lei={$term->slug}";
		$activ_sel = ($lei== trim($term->slug)) ? 'style="background:#F00; color:#FFF"' : '';	
		
		$leiurl = ''; if (!empty($lei1)) $leiurl =  "&lei1={$lei1}";
		
	 ?>
	 <a <?php echo  $activ_sel ?> href="<?php echo $url_bs.$lei_url.$leiurl ?>">
	 <?php echo $term->name ?>
	 </a> 
	 <?php 
	
}
?>
<br />
<?php 
foreach ($terms1 as $term1) 
{
				
		$lei_url1 = ''; if (!empty($term1->slug))  $lei_url1 = "&lei1={$term1->slug}";
		$activ_sel1 = ($lei1== trim($term1->slug)) ? 'style="background:#F00; color:#FFF"' : '';
		$leiurl = ''; if (!empty($lei)) $leiurl =  "&lei={$lei}";			
	 ?>
	 <a <?php echo  $activ_sel1 ?> href="<?php echo $url_bs.$lei_url1.$leiurl ?>">
	 <?php echo $term1->name ?>
	 </a> 
	 <?php 
	
}
?>

<br />
<ul>
<?php 
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
			
	

			$query = new WP_Query( $args );
			
			if (!empty($query->posts)) {
				
					$rs = $query->posts;
								foreach ($rs as $rs_o) {
							$img_url = get_post_meta($rs_o->ID,'_id_upload_students',true);
						?>
						
	
			<li>
		标题<?php echo $rs_o->post_title;  ?>
		
		图片<img  src="<?php echo $img_url ?>" width="200" height="200"    />
</li>			
						
						<?php 
						
						
						
					}
			}
			wp_reset_postdata();
?>
</ul>