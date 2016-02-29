<?php 
$post_id = $post->ID; 
$img_url = get_post_meta($post_id,'_id_upload_teachers',true); 
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
							
							 	    <div id="SOHUCS"></div>
								<script charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/changyan.js" ></script>
								<script type="text/javascript">
								    window.changyan.api.config({
								        appid: 'cys3XmfBU',
								        conf: 'prod_674cebb9c09386b41dfc0b70d2a82563'
								    });
								</script> 
							<?php 
                		    
                		}else{
                		   $echopost_c = $post_c ;
                		   
                		   echo $echopost_c;
                		  
                		  
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