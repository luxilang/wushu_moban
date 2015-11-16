
	 <!--tab-->
   
	<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <ul class="nav nav-tabs" role="tablist">
            <?php 
		   $courses_tab_arr = array('儿童组','少年组','成人组','1对1私教课程');
		   $courses_tab_desc_arr = array('授课对象为3岁-10岁少儿','授课对象为10岁-17岁少儿','授课对象为18岁以上成年人','所有课程都设有1对1私教');
		   $tab_id = 1;
		   foreach($courses_tab_arr as $courses_tab_arr_k=>$courses_tab_arr_v)
		   {
				$active_str_1 = '';
			   if($courses_tab_arr_k == 0) $active_str_1 ='class="active"';
				?>
			  
				  <li role="presentation" <?php echo $active_str_1 ?>><i></i><a href="#<?php echo $tab_id ?>" aria-controls="<?php echo $tab_id ?>" role="tab" data-toggle="tab">
				  <label><?php echo $courses_tab_arr_v ?></label>
				  <span><?php echo $courses_tab_desc_arr[$courses_tab_arr_k] ?></span></a></li>
			   <?php 
			   $tab_id++;
		   }
			   ?>
   
          </ul>
          <div class="tab-content">
          	<!--1-->
            <?php
			$tab_id_1 = 1;
			
           foreach($courses_tab_arr as $courses_tab_arr_k=>$courses_tab_arr_v)
		   {
			   $active_str_2 = '';
			   if($courses_tab_arr_k == 0) $active_str_2 ='active';
			   
			    if($courses_tab_arr_v =='儿童组')
				{
					$courses_tab_arr_v = '少儿组';
				}
				
			?>
            <div class="row tab-pane <?php echo $active_str_2 ?>"  role="tabpanel" id="<?php echo  $tab_id_1 ?>">
            
              <?php 
			   $rs = custom_type_class_meta('courses',$courses_tab_arr_v,'_is_top');
			   if (!empty($rs)) 
			   {
				   foreach ($rs as $key => $rs_o) {
					   $img_url = get_post_meta($rs_o->ID,'_id_upload_home',true);
			  ?>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="box"> <img src="<?php echo $img_url ?>" width="280" height="216">
                  <div class="info">
                    <h3><?php echo  $rs_o->post_title ?></h3>
                    <label>授课方式：<?php echo  get_post_meta($rs_o->ID,'_skfs_courses',true) ?></label>
                    <label>学员至上：<?php echo  get_post_meta($rs_o->ID,'_syzs_courses',true) ?></label>
					<label>授课对象：<?php echo  get_post_meta($rs_o->ID,'_skdx_courses',true) ?></label>
                    <label>优惠活动：<?php echo  get_post_meta($rs_o->ID,'_yhhd_courses',true) ?></label>
                    <a href="<?php echo get_permalink($rs_o->ID); ?>"><i class="glyphicon glyphicon-plus-sign"></i>查看详情</a>
                  </div>
                </div>
              </div>
 			<?php 
				   }
			   }
			?>
              
            </div>
            
            <?php
				$tab_id_1 ++;
		   }
			?>

          </div>
        </div>
      </div>
