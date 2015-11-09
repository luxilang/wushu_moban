<?php
$lei = !empty($_GET['lei']) ?  strip_tags($_GET['lei']) : 'feng1,xlhx'; 
$url = '?post_type=students';
if(!empty($lei)) $url .="&lei={$lei}";


$arr_str = array(
	'武术'=>'feng1',
	'散打'=>'feng2',
	'跆拳道'=>'feng3',
	'太极拳'=>'feng4',
	'空翻'=>'feng5',
);
$arr_str1 = array(
	'训练花絮'=>'xlhx',
	'比赛锦集'=>'bsjj',
	'获奖证书'=>'hjzs',
	'学员表演'=>'xyby'
);

function set_url_lei($lei1,$lei2) {
	
	$url = "?post_type=students&lei={$lei1},$lei2";
	return  $url;
}

 		$post_type = get_post_type();
 		$post_type_obj = get_post_type_object(get_post_type());
 		?>
 		<a href="<?php echo home_url() ?>" >首页</a>-><?php echo $post_type_obj->label ?>
 		<br />
 		<?php 
 		foreach ($arr_str as $key=> $value) {
 			?>
 			<?php echo $key ?>   -- 
 					<?php 
 						foreach ($arr_str1 as $arr_str1key => $arr_str1value) {
 							?>
 							<a href="<?php echo  set_url_lei($value,$arr_str1value) ?>"><?php echo $arr_str1key ?></a> 
 							|
 							<?php 
 						}
 					?>
 				<br />
 			<?php 
 		}
 		

 		
 		?>
 		
		<ul>
 		<?php 
 		
		 	if (!empty($lei)) {
				$lei_arr = explode(',', $lei);
			}
 			if (count($lei_arr) == 2) {
 				
 				list($students_type,$imgs_type) = $lei_arr;
 				

	 				$args = array(
					'post_type'  => 'students',
				    'meta_key'   => '_id_imgs_type',
				    'meta_query' => array(
				        array(
				            'key'     => '_id_imgs_type',
				            'value'   => $imgs_type,
				            'compare' => 'REGEXP',
				        ),
				    ),
				    'tax_query' => array(
				        'relation' => 'AND',
				        array(
				            'taxonomy' => 'students_type',
				            'field'    => 'slug',
				            'terms'    => array( "$students_type"),
				        ),
				    ),
				);
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
 			}
 		?>


