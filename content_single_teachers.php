<?php 
$post_id = $post->ID; 
$img_url = get_post_meta($post_id,'_id_upload_teachers',true); 

$img_url = my_thumb_img($img_url,"&w=274&h=370".get_timthumb_cf());
?>
<div class="row content">
      	<div class="col-lg-12">
        	<div class="row view-info">
            	<div class="col-lg-4 col-xs-6 col-lg-offset-0 col-xs-offset-3">
                	<img src="<?php echo $img_url  ?>">
                </div>
                <div class="col-lg-8 col-xs-12">
                	<h3><?php echo $post->post_title ?></h3>
                    <label><span>姓名：</span><?php echo get_post_meta($post_id,'_teachers_name',true); ?></label>
                    <label><span>习武年限：</span><?php echo get_post_meta($post_id,'_teachers_xwnx',true);  ?></label>
                    <label><span>武术段位：</span><?php echo get_post_meta($post_id,'_teachers_wsdw',true);  ?></label>
                    <label><span>运动等级：</span><?php echo get_post_meta($post_id,'_teachers_yddj',true);  ?></label>
                    <label><span>武术最高级别：</span><?php echo get_post_meta($post_id,'_teachers_wszgjb',true);  ?></label>
                    <label><span>少儿武术教学经验：</span><?php echo get_post_meta($post_id,'_teachers_sewsjljy',true);  ?></label>
                    <label><span>毕业于：</span><?php echo get_post_meta($post_id,'_teachers_by',true);  ?></label>
                    <label class="fg">教学风格：<?php echo get_post_meta($post_id,'_teachers_jxfg',true);  ?></label>
                    <button type="button" class="btn btn-blue btn-lg" data-toggle="modal" data-target="#yyModal"><i class="glyphicon glyphicon-plus"></i>我要体验<span class="bubble">预约</span></button>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="view-detail">
              <ul class="nav nav-tabs nav-tabs-view" role="tablist">
              
         <?php 

	$ashu_teachers_tab_arr = get_option('ashu_teachers_tab');
	$teachers_tab_ini = trim($ashu_teachers_tab_arr['_teachers_tab_ini']);
				if (!empty($teachers_tab_ini)) {
				
					$teachers_tab_ini_arr = array_filter(explode("\r\n", $teachers_tab_ini));
					if (!empty($teachers_tab_ini_arr)) {
						foreach ($teachers_tab_ini_arr as $key => $value) {
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
			  	if (!empty($teachers_tab_ini_arr)) {
						foreach ($teachers_tab_ini_arr as $key => $value) {
							$tab_id1 = $key+1;
							if (!empty($value)) {
								list($tab_option_name,$tab_option_id,$tab_option_desc) =  explode("|", $value);
								
								$active_tab1 = ($key==0)   ?  'active' : ''; 
								
			  ?>

                <div class="row tab-pane <?php echo $active_tab1 ?>"  role="tabpanel" id="<?php echo $tab_id1 ?>">
                		<?php 
                		
                		
                		$post_c =  get_post_meta($post_id,$tab_option_id,true); 
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
                		    
                		}else{
							if ('_id_tinymce_xyxs' == $tab_option_id) {
      			        	 
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
							                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-right">
							                                	<span class="time">
							                                    	<?php echo $riqi ?>
							                                    </span>
							                                </div>
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
                			}elseif('_id_tinymce_jxcg' == $tab_option_id ){ 

                				echo  jxcg_ktzs(get_postimg_list($tab_option_id,$post_id,'',"&w=260&h=194".get_timthumb_cf()));
                			}elseif('_id_tinymce_ktzs' == $tab_option_id ){	 //课程展示
                				echo  jxcg_ktzs(get_postimg_list($tab_option_id,$post_id,'',"&w=274&h=370".get_timthumb_cf()));
                				
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
<?php  $zaixian_submit_type = 1 //教练  ;?>
<?php include_once 'modal.php';  ?>