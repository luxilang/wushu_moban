<?php
/*
Template Name: 信息布局模板  
*/ 
function echo_layout($html)
{
	global $post,$post_type_conf,$nav_post_type;
	get_header();

?>
<div class="container">
  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3 page-left hidden-xs">
     <?php echo get_template_part('layout','left');?>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 page-right">
    
    <?php 
			if(is_page())
			{
				
			}else if(is_single()){
				$post_type = get_post_type();
 				$post_type_obj = get_post_type_object(get_post_type());
				?>
              <!--title-->
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="class-title">
                    <label>课程介绍</label>
                    <ol class="breadcrumb">
                      <li><a href="<?php echo site_url() ?>">首页</a></li>
                      <li><a href="<?php echo site_url() ?>?post_type=<?php echo $post_type ?>"><?php echo $post_type_obj->label ?></a></li>
                      <li class="active"><?php echo get_the_title() ?></li>
                    </ol>
                  </div>
                </div>
              </div>
                <?php
				
			}else{
		
        	//print_R(get_post_type_object());
        	/**
        	 * 
        	 * 没有post 数据 就得不到 数据所以改一下
        	 * @var unknown_type
        	 */
        	/**
        		
 				$post_type_obj = get_post_type_object(get_post_type());
 				echo $post_type_obj->label
 				//print_R($post_type_obj);*/
        		//$post_type_get =get_post_type();
			
						?>
                        
                        
                        <?php	
					
        			if (!empty($post_type_conf) && !empty($_GET['post_type'])) {
						$post_type_str_arr = array();
						foreach ($post_type_conf as $value) {
							$post_type_str_arr[$value['post_code']] = $value['post_str'];
						}
						$post_type_str = $post_type_str_arr[$_GET['post_type']];
					
		
        			?> 
                 <!--title-->
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="class-title">
                        <label><?php echo $post_type_str ?></label>
                        <ol class="breadcrumb">
                          <li><a href="<?php echo site_url() ?>">首页</a></li>
                          <li class="active"><?php echo $post_type_str ?></li>
                        </ol>
                      </div>
                    </div>
                  </div>
                    
        			<?php 
					
        		}	
			}
	
	?>
    
    
    
     <?php require $html; ?>
      <!--map-->
      
      <?php
		$get_post_type_str  = get_post_type();
	  	if(is_page(3))
		{
		}elseif ($get_post_type_str == 'class_activities'){

		}else{
	  ?>
     		 <?php   echo $content = get_post('5')->post_content;   ?>
      	<?php
		}
		?>
    </div>
    		<!--兼容-->
        	<div class="col-xs-12 page-left hidden-lg hidden-md hidden-sm">
              <div class="row">
                <!--三级菜单-->
                    
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <ul class="level-3-menu">
                        <li><a href="/?post_type=class_env"><i class="class-icon icon-skhj"></i>上课环境</a></li>
                        <li><a href="/?post_type=class_time"><i class="class-icon icon-sksj"></i>上课时间</a></li>
                        <li><a href="/?post_type=class_fee"><i class="class-icon icon-kcfy"></i>课程费用</a></li>
                        <li><a href="/?post_type=class_activities"><i class="class-icon icon-yhhd"></i>优惠活动</a></li>
                      </ul>
                    </div>
                    
              </div>
            </div>
            <!--兼容-->
  </div>
</div>
<?php 
	get_footer();
}
?>