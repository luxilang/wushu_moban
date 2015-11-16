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
    <div class="col-lg-3 col-md-3 col-sm-3 page-left">
     <?php echo get_template_part('layout','left');?>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9 page-right">
    
    <?php 
			if (!is_page() ) {
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
        		if (!empty($post_type_conf) && !empty($_GET['post_type'])) {
        			$post_type_str_arr = array();
        			foreach ($post_type_conf as $value) {
        				$post_type_str_arr[$value['post_code']] = $value['post_str'];
        			}
        			$post_type_str = $post_type_str_arr[$_GET['post_type']];
        			?>
        			
                    
                 <!--title-->
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
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
  </div>
</div>
<?php 
	get_footer();
}
?>