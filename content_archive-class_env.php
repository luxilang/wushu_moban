

      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
 
          <ul class="nav nav-tabs" role="tablist">
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
				
				
				 $activ_sel = ($lei== trim($term->slug)) ? 'class="active"' : '';			
	 ?>
            <li role="presentation"  <?php echo  $activ_sel ?> ><i></i><a href="<?php echo $url_bs.$lei_url ?>" >
              <label> <?php echo $term->name ?></label>
              </a></li>

              	 <?php 
	
}
?>
          </ul>
          <div class="tab-content">
          	<!--1-->
            <div class="row tab-pane active"  role="tabpanel" id="1">
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
            	<div class="col-lg-4">
                	<div class="picList">
                    	<div class="b-layer"><i class="glyphicon glyphicon-plus"></i></div>
                    	<img src="<?php echo $img_url ?>" width="274" height="220">
                    </div>
                </div>
                <?php 
					}
			}
			wp_reset_postdata();
			?>
               
              	<div class="col-lg-4 col-xs-offset-4">
                	<button type="button" class="btn btn-lg btn-block btn-blue">加载更多  <i class="glyphicon glyphicon-save"></i></button>
                </div>
            </div>

            <!--tab end-->
          </div>
        </div>
      </div>

						
						