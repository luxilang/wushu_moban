<?php
get_header();
  	   $home_tab_arr = array('儿童组','少年组','成人组','1对1私教课程');
	   $home_tab_desc_arr = array('授课对象为3岁-10岁少儿','授课对象为10岁-17岁少儿','授课对象为18岁以上成年人','所有课程都设有1对1私教');
    
		function show_nav($home_tab_arr,$home_tab_desc_arr){
		
    
			$tab_id_2 = 1;
			$html = '';
		   foreach($home_tab_arr as $home_tab_arr_k=>$home_tab_arr_v)
		   {
			   $active_str_hehe = '';
			   if($home_tab_arr_k == 0)
			   {
				   $active_str_hehe ='class="active"';
			   }
			
			
				$html .=  '<li role="presentation" '.$active_str_hehe.' ><i></i><a href="#'.$tab_id_2.'" aria-controls="'.$tab_id_2.'" role="tab" data-toggle="tab">';
				$html .= '<label>'.$home_tab_arr_v.'</label>';
				$html .= '<span>'.$home_tab_desc_arr[$home_tab_arr_k].'</span></a></li>';

			 
				$tab_id_2 ++;
		   }
			return $html;
		}
?>
<div class="container content"> 
  <!--武术课程-->
  <div class="row title">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h1>我们提供的各年龄段武术课程</h1>
      <label>培训项目：少儿武术、散打防身术、太极拳、跆拳道、擒拿格斗、空翻，所有项目（男子女子均可）最低年龄需在3周岁以上</label>
    </div>
  </div>
  <div class="course">
    <div class="row">
      <div class="hidden-lg hidden-md hidden-sm col-xs-12 course-tab">
        <ul class="nav nav-tabs" role="tablist">
			<?php  echo show_nav($home_tab_arr,$home_tab_desc_arr); ?>
        </ul>
      </div>
      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 tab-content"> 
      <?php 
	  	$tab_id = 1;
		   $html = '';
		   foreach($home_tab_arr as $home_tab_arr_k=>$home_tab_arr_v)
		   {
				$active_str_1 = '';
			   if($home_tab_arr_k == 0)
			   {
				   $active_str_1 ='active';
			   }
			   
			   
			?>
      
                    <div class="row tab-pane <?php echo $active_str_1 ?>" role="tabpanel" id="<?php   echo $tab_id ?>">
                    		<?php 
								$sql = "
							SELECT wp_posts.* FROM wp_posts
							LEFT JOIN  
							wp_term_relationships  ON 
							wp_term_relationships.object_id  = wp_posts.ID
							LEFT JOIN
							wp_term_taxonomy
							ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
							LEFT JOIN 
							wp_terms 
							ON  wp_terms.term_id = wp_term_taxonomy.term_id
							WHERE wp_terms.name = '{$home_tab_arr_v}' 
							LIMIT 3
							";
							$rs = $wpdb->get_results($sql);
						
							if (!empty($rs)) {
								foreach ($rs as $key => $rs_o) {
									$img_url = get_post_meta($rs_o->ID,'_id_upload_home',true);
							?>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                  <div class="box"> <img src="<?php echo $img_url ?>" width="280" height="216">
                                    <div class="info">
                                      <h3><a href="<?php echo get_permalink($rs_o->ID); ?>" ><?php echo  $rs_o->post_title ?></a></h3>
                                      <label>授课方式：<?php echo  get_post_meta($rs_o->ID,'_skfs_courses',true) ?></label>
                                      <label>优惠活动：<?php echo  get_post_meta($rs_o->ID,'_yhhd_courses',true) ?></label>
                                    </div>
                                  </div>
                          </div>
							<?php 
								}
							}
							
							?>
                    </div>
                
                <?php	
                            $tab_id ++ ;		   
                   }
                ?>
       
        
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs course-tab">
        <ul class="nav nav-tabs" role="tablist">
			<?php  echo show_nav($home_tab_arr,$home_tab_desc_arr); ?>
        </ul>
      </div>
    </div>
  </div>
 <!--选择我们-->
  <?php 
		echo $content = get_post('9')->post_content;   
    ?>
  <!--我们的团队-->
  <?php 
		echo $content = get_post('11')->post_content;   
    ?>
  <!--家长评价-->
  <?php 
		echo $content = get_post('13')->post_content;   
    ?>
</div>
<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="address">
          <h3>首都体育学院校区</h3>
          <label><span>学院地址：</span>首都体育学院训练2馆2层-位于海淀北三环蓟门桥西（靠近大学生体育馆）</label>
          <label><span>联系电话：</span>189-1163-9063 罗老师</label>
          <label><span>乘车路线：</span>公交在"蓟门桥西"下车</label>
          <label><span>地铁路线：</span>13号线"大钟寺"下车</label>
        </div>
        <div class="address">
          <h3>首都体育学院校区</h3>
          <label><span>学院地址：</span>海淀体育中心内-海淀体育运动学校武术馆（靠近北京大学）</label>
          <label><span>联系电话：</span>135-8189-4868 吴老师</label>
          <label><span>乘车路线：</span>公交车在"海淀桥北"下车</label>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="code"> <img src="dist/img/footer-code.jpg">
          <label>扫描二维码<span>用手机访问本站</span></label>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 copyright"> <span>Copyright(c)2010-2015 武术世家 版权所有    京ICP备11008151号京公网安备11010802014853</span> </div>
    </div>
  </div>
</div>
<script src="dist/js/jQuery-1.11.2.js"></script> 
<script src="dist/js/bootstrap.min.js"></script> 
<script>
	/*$(function(){
		$('.reason').find('.blue-box').height(400);
	})*/
</script>
</body>
</html>
