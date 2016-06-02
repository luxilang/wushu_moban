<?php
$post_id = $post->ID; //首选需要获取文章id
$img_url = get_post_meta($post_id,'_id_upload_courses',true); 
$img_url = site_url()."/wp-content/uploads/timthumb.php?src=".site_url().$img_url."&w=274&h=370&q=100&zc=1&ct=1&a=t";
?>
<div class="row contact">
        <div class="col-lg-12">
          <div class="row view-info">
            <div class="col-lg-4 col-xs-6 col-lg-offset-0 col-xs-offset-3"> <img src="<?php echo $img_url ?>" width="274" height="370"> </div>
            <div class="col-lg-8 col-xs-12">
              <h3><?php echo $post->post_title ?></h3>
              <label><span>授课对象：</span><?php echo get_post_meta($post_id,'_skdx_courses',true);  ?></label>
              <label><span>课程简述：</span><?php echo get_post_meta($post_id,'_duandesc_courses',true);  ?></label>
              <label><span>授课时间：</span><?php echo get_post_meta($post_id,'_sksj_courses',true);  ?></label>
              <label><span>课程费用：</span><?php echo get_post_meta($post_id,'_skfy_courses',true);  ?></label>
              <label><span>开班信息：</span><?php echo get_post_meta($post_id,'_kbxi_courses',true);  ?></label>
              <label class="fg">学员至上：<?php echo get_post_meta($post_id,'_syzs_courses',true);  ?></label>
              <button type="button" class="btn btn-blue btn-lg"  data-toggle="modal" data-target="#yyModal" ><i class="glyphicon glyphicon-plus"></i>免费试课<span class="bubble">预约</span></button>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="view-detail">
              <ul class="nav nav-tabs nav-tabs-view" role="tablist">
              <?php 
			    $ashu_courses_tab_arr = get_option('ashu_courses_tab');
				$courses_tab_ini = trim($ashu_courses_tab_arr['_courses_tab_ini']);
				
				if (!empty($courses_tab_ini)) {
				
					$courses_tab_ini_arr = array_filter(explode("\r\n", $courses_tab_ini));
					if (!empty($courses_tab_ini_arr)) {
						foreach ($courses_tab_ini_arr as $key => $value) {
							$tab_id = $key+1;
							if (!empty($value)) {
								list($tab_option_name,$tab_option_id,$tab_option_desc) =  explode("|", $value);
								
								$active_tab = ($key==0)   ?  'class="active"' : ''; 
								?>
                                <li role="presentation" <?php echo  $active_tab ?>><i></i><a href="#<?php echo $tab_id ?>" aria-controls="<?php echo $tab_id ?>" role="tab" data-toggle="tab">
                              <label><?php echo $tab_option_name  ?> </label>
                              </a></li>
                                
                                <?php
								// get_post_meta($post_id,$tab_option_id,true)
							}
						
						}
					}
				
				}
			  ?>
              </ul>
              <div class="tab-content tab-content-view">
              <?php  
			  	if (!empty($courses_tab_ini_arr)) {
						foreach ($courses_tab_ini_arr as $key => $value) {
							$tab_id1 = $key+1;
							if (!empty($value)) {
								list($tab_option_name,$tab_option_id,$tab_option_desc) =  explode("|", $value);
								
								$active_tab1 = ($key==0)   ?  'active' : ''; 
								
			  ?>
                <!--1-->
                <div class="row tab-pane <?php echo $active_tab1 ?>"  role="tabpanel" id="<?php echo $tab_id1 ?>">
                		<?php 
                		$post_c = get_post_meta($post_id,$tab_option_id,true);
                		if ($tab_option_id == '_id_tinymce_kzyd') { //扩展阅读
                		    $post_c = trim($post_c);
                		    $post_c = str_replace('，', ',', $post_c);
                		    $content_id_arr = array_filter(explode(",", $post_c));
                		    
                		    $wp_article_id = $content_id_arr[0];
                		    
                		    $sql = "SELECT * FROM wp_article WHERE id ='{$wp_article_id}' LIMIT 1";
							$rs = $wpdb->get_results($sql);
						
							if (!empty($rs[0]))  echo  get_bendi_wenzhang($rs);;
							?>

								<?php include_once 'changyan_js.php';  ?>
							<?php 
                		    
                		}
                		else if ($tab_option_id == '_id_tinymce_jljj' )  //教练简介
                		{
                			
                			?>
                			<?php include_once 'tab_teachers_info.php';  ?>
      
                				<?php 
                		}else{
                				if ('_id_tinymce_kcpj' == $tab_option_id) {
      			        	 
                			        	$sql = "  select * from wp_courses_ping  where post_id = '{$post_id}' order by id desc  ";
                			        	
                			        	$courses_ping_rs =  $wpdb->get_results($sql);
                			        	$curr_ttt = time();
                		
                			        	
                					
                					?>
					        		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
					        		<?php 
					        			        	if (!empty($courses_ping_rs)) {
					                			        		foreach ($courses_ping_rs as $courses_ping_k=>$courses_ping_rs_value) {
					                			        			$dfff_time = ($courses_ping_k * 24*3600);
					                			        			$curr_ttt = time();
					                			        			$re_time = $curr_ttt-$dfff_time;
					                			        			$riqi = date('Y-m-d',$re_time);
					        		?>
					                  <!---->
					                  <div class="box">
					                    <div class="row">
					                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					                        <label><img src="<?php echo $courses_ping_rs_value->touxiang ?>"><?php echo $courses_ping_rs_value->xingming ?><span><?php echo $courses_ping_rs_value->beizhu ?></span></label>
					                      </div>
					                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-right"> <span class="time"> <?php echo $riqi ?></span> </div>
					                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 info">
					                        <p><?php echo $courses_ping_rs_value->pinglun ?></p>
					                      </div>
					                    </div>
					                  </div>
					                  <!---->
					                  <?php 
					                			      }
					        			        	}
					                  ?> 
					                  
					                </div>
                					
                			        
                					<?php 
                				}elseif('_id_tinymce_xycg' == $tab_option_id){
                					
                				?>
                									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													                  <ul class="nav nav-tabs nav-tabs-level2" role="tablist">
													                    <li role="presentation" class="active"><i></i><a href="#5_1" aria-controls="5_1" role="tab" data-toggle="tab">
													                      <label>训练花絮</label>
													                      </a></li>
													                    <li role="presentation"><i></i><a href="#5_2" aria-controls="5_2" role="tab" data-toggle="tab">
													                      <label>比赛集锦</label>
													                      </a></li>
													                    <li role="presentation"><i></i><a href="#5_3" aria-controls="5_3" role="tab" data-toggle="tab">
													                      <label>获奖证书</label>
													                      </a></li>
													                    <li role="presentation"><i></i><a href="#5_4" aria-controls="5_4" role="tab" data-toggle="tab">
													                      <label>学员表演</label>
													                      </a></li>
													                  </ul>
												                  <div class="tab-content"> 
												                  	<div class="row tab-pane active"  role="tabpanel" id="5_1">
												                  	<?php 
												                  			echo  xycg(get_postimg_list('_id_tinymce_xycg',$post_id,'训练花絮',"&w=274&h=370".get_timthumb_cf()));
												                  	?>
												                  	</div>
												
												                  	<div class="row tab-pane"  role="tabpanel" id="5_2">
												                  	<?php 
												                  			echo  xycg(get_postimg_list('_id_tinymce_xycg',$post_id,'比赛集锦',"&w=274&h=370".get_timthumb_cf()));
												                  	?>
												              
												                  	</div>
												                  	 <div class="row tab-pane"  role="tabpanel" id="5_3">
												                  	
												                  	<?php 
												                  			echo  xycg(get_postimg_list('_id_tinymce_xycg',$post_id,'获奖证书',"&w=274&h=370".get_timthumb_cf()));
												                  	?>
												                  			
												                  	</div>
												                  	      <div class="row tab-pane"  role="tabpanel" id="5_4">
												                  	<?php 
												                  			echo  xycg(get_postimg_list('_id_tinymce_xycg',$post_id,'学员表演',"&w=274&h=370".get_timthumb_cf()));
												                  	?>
												                  			
												                  	</div>
												
												                  </div>
												                </div>
                				<?php
                			
                				}else{

                			
                			
		                			$post_c = str_replace("{jintian_date}",date('Y-m-d'),$post_c ); 
		                			$post_c = str_replace("{zuotian_date}",date('Y-m-d',time()-24*3600),$post_c ); 
		                			$post_c = str_replace("{qiantian_date}",date('Y-m-d',time()-2*24*3600),$post_c ); 
		                		   $echopost_c = $post_c ;
		                		   echo $echopost_c;
                				}
                	
                		}
                		
                		?>
                </div>
               <?php 
							}
						}
				}
			   ?>

              </div>
           </div>
        </div>
        
      </div>
<?php  $zaixian_submit_type = 2 //教练  ;?>
<?php include_once 'modal.php';  ?>

<?php
/***** 
//调用相关的  学员信息
$connected = new WP_Query( array(
  'connected_type' => 'courses_to_teachers',
  'connected_items' => get_queried_object(),
  'nopaging' => true,
) );

// Display connected pages
if ( $connected->have_posts() ) :
?>
<h3>教练简介：</h3>
<ul>
<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; ?>
</ul>

<?php 
// Prevent weirdness
wp_reset_postdata();

endif;
?>


<?php 
//调用相关的  学员信息
$connected = new WP_Query( array(
  'connected_type' => 'courses_to_students',
  'connected_items' => get_queried_object(),
  'nopaging' => true,
) );

// Display connected pages
if ( $connected->have_posts() ) :
?>
<h3>学员风采</h3>
<ul>
<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; ?>
</ul>

<?php 
// Prevent weirdness
wp_reset_postdata();

endif;
?>

免费试课
*/
?>
