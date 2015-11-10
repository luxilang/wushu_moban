<br />
<?php


			$args['post_type'] = 'class_activities';

			$query = new WP_Query( $args );
			
			if (!empty($query->posts)) {
					$rs = $query->posts;
					foreach ($rs as $rs_o) {
							$img_url = get_post_meta($rs_o->ID,'_id_upload_activities',true);
						?>
						活动内容:<?php echo $rs_o->post_content ?><br />
						图片<img  src="<?php echo $img_url ?>" width="200" height="200"    /><br />
						<hr />
						<?php 
					}
			}
			wp_reset_postdata();