
 		<?php 
 		$post_type = get_post_type();
 		$post_type_obj = get_post_type_object(get_post_type());
 		?>
 		<a href="<?php echo home_url() ?>" >首页</a>-><?php echo $post_type_obj->label ?>
 		<br />
 		<?php 
 			function out_post_type($rs) {
 				
 				
 			
 				if (!empty($rs)) {
 					foreach ($rs as $key => $rs_o) {
 						?>
 							类型:<?php echo  $rs_o->name ?><br />
 							标题:<?php echo  $rs_o->post_title ?><br />
             			摘要:<?php echo $rs_o->post_excerpt ?><br />
                		图片:<?php $img_url = get_post_meta($rs_o->ID,'_id_upload_courses',true); ?>
                <img  src="<?php echo $img_url ?>" width="200" height="200" />
                
                      <a href="<?php echo get_permalink($rs_o->ID); ?>">查看详细</a>   
                <br />;
 						<?php 
 					}
 				}
 			}
 		    //少儿组的
			out_post_type(custom_type_class_meta($post_type,'少儿组','_is_top')) ;
 			out_post_type(custom_type_class_meta($post_type,'少年组','_is_top')) ;
 			out_post_type(custom_type_class_meta($post_type,'成人组','_is_top')) ;
 			out_post_type(custom_type_class_meta($post_type,'1对1私教课程','_is_top')) ;
 			

 		?>



