
<div class="row content">
	<?php

			$args['post_type'] = 'class_activities';

			$query = new WP_Query( $args );
			
			if (!empty($query->posts)) {
					$rs = $query->posts;
					foreach ($rs as $rs_o) {
							$img_url = get_post_meta($rs_o->ID,'_id_upload_activities',true);
						?>
                        <div class="col-lg-4">
                            <div class="box"> <img src="<?php echo $img_url ?>" width="259" height="202">
                            <div class="info">
                              <h3> <?php echo $rs_o->post_title ?></h3>
                              <label>
                              <?php echo $rs_o->post_content ?>
                              </label>
                            </div>
                          </div>
                        </div>
      
   						<?php 
					}
			}
			wp_reset_postdata();
			?>     
      </div>
