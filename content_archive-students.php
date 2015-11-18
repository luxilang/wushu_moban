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
?>
<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <ul class="nav nav-tabs" role="tablist">
          	<?php 
			$tab_1 = 1;
			foreach ($terms as $term) 
			{
							
					$lei_url = ''; if (!empty($term->slug))  $lei_url = "&lei={$term->slug}";
					$activ_sel = ($lei== trim($term->slug)) ? 'class="active"' : '';	
					
					$leiurl = ''; if (!empty($lei1)) $leiurl =  "&lei1={$lei1}";
					
				 ?>
                <li role="presentation" <?php echo $activ_sel ?>  ><i></i><a href="<?php echo $url_bs.$lei_url.$leiurl ?>" >
                  <label><?php echo $term->name ?></label>
                  </a></li>
				 <?php 
				$tab_1 ++;
			}
			?>
          </ul>
          <div class="tab-content"> 
            <!--1-->
            <div class="row tab-pane active"  role="tabpanel" id="1">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs nav-tabs-level2" role="tablist">
					<?php 
                    foreach ($terms1 as $term1) 
                    {
                                    
                            $lei_url1 = ''; if (!empty($term1->slug))  $lei_url1 = "&lei1={$term1->slug}";
                            $activ_sel1 = ($lei1== trim($term1->slug)) ? 'class="active"' : '';
                            $leiurl = ''; if (!empty($lei)) $leiurl =  "&lei={$lei}";			
                         ?>
                         <li role="presentation" <?php echo  $activ_sel1 ?>><i></i><a href="<?php echo $url_bs.$lei_url1.$leiurl ?>" >
                            <label><?php echo $term1->name ?></label>
                            </a></li>
                         <?php 
                        
                    }
                    ?>
                </ul>
                <div class="tab-content">

                  <div class="row tab-pane active"  role="tabpanel" id="1_1">
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
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                      <div class="picList">
                        <div class="b-layer"><i class="glyphicon glyphicon-plus"></i></div>
                        <img src="<?php echo $img_url ?>"  width="274" height="370"> </div>
                    </div>
                    <?php 
						
					}
			}
			wp_reset_postdata();
					?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<div class="row">
                        	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                              <button type="button" class="btn btn-lg btn-block btn-blue">加载更多 <i class="glyphicon glyphicon-save"></i></button>
                            </div>
                        </div>
                    </div>
                  </div>

                </div>
                
                
                
                
              </div> 
            </div>
            <!--1 end-->

          </div>
        </div>
      </div>
