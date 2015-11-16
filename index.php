<?php
get_header();
?>
<div class="container content"> 
  <!--武术课程-->
  <div class="row title">
    <div class="col-lg-12 col-md-12">
      <h1>我们提供的各年龄段武术课程</h1>
      <label>培训项目：少儿武术、散打防身术、太极拳、跆拳道、擒拿格斗、空翻，所有项目（男子女子均可）最低年龄需在3周岁以上</label>
    </div>
  </div>
  <div class="course"><div class="row">
    <div class="col-lg-9 col-md-9 tab-content"> 
     <?php 
	 
	   $home_tab_arr = array('少儿组','少年组','成人组','1对1私教课程');
	   $home_tab_desc_arr = array('授课对象为3岁-10岁少儿','授课对象为10岁-17岁少儿','授课对象为18岁以上成年人','所有课程都设有1对1私教');
	   $tab_id = 1;
	   foreach($home_tab_arr as $home_tab_arr_k=>$home_tab_arr_v)
	   {
		    $active_str_1 = '';
		   if($home_tab_arr_k == 0)
		   {
			   $active_str_1 ='active';
		   }
		?>
      <div class="row tab-pane <?php echo $active_str_1 ?>" role="tabpanel" id="<?php echo $tab_id ?>">
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
	    //AND wp_term_taxonomy.taxonomy = '{$post_type}' 
		$rs = $wpdb->get_results($sql);
	
		if (!empty($rs)) {
			foreach ($rs as $key => $rs_o) {
				$img_url = get_post_meta($rs_o->ID,'_id_upload_home',true);
				?>
        <div class="col-lg-4 col-md-4">
          <div class="box"> <img src="<?php echo $img_url ?>" width="280" height="216">
            <div class="info">
              <h3><?php echo  $rs_o->post_title ?></h3>
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
    <div class="col-lg-3 col-md-3 course-tab">
      <ul class="nav nav-tabs" role="tablist">
      	<?php
		 $tab_id_2 = 1;
       foreach($home_tab_arr as $home_tab_arr_k=>$home_tab_arr_v)
	   {
		   $active_str_hehe = '';
		   if($home_tab_arr_k == 0)
		   {
			   $active_str_hehe ='class="active"';
		   }
		?>
        <li role="presentation"  <?php echo $active_str_hehe  ?> ><i></i><a href="#<?php echo $tab_id_2 ?>" aria-controls="<?php echo  $tab_id_2 ?>" role="tab" data-toggle="tab">
          <label><?php echo $home_tab_arr_v ?></label>
          <span><?php echo $home_tab_desc_arr[$home_tab_arr_k] ?></span></a></li>
         <?php
		 	$tab_id_2 ++;
	   }
		 ?>
      </ul>
    </div>
  </div></div>
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



<?php
get_footer();

?>
