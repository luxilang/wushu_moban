<?php

	
/*
Template Name: 信息布局模板  
*/ 
function echo_layout($html)
{
	global $post,$post_type_conf;
	get_header();

?>

<table width="100%" border="1">
  <tr>
    <td width="8%" height="420" align="left" valign="top"><?php echo get_template_part('layout','left');?></td>
    <td width="92%" align="left" valign="top">
        <?php 
        
        if (!is_page() ) {
        	//print_R(get_post_type_object());
        	/**
        	 * 
        	 * 没有post 数据 就得不到 数据所以改一下
        	 * @var unknown_type
        	 */
        	/**
        		$post_type = get_post_type();
 				$post_type_obj = get_post_type_object(get_post_type());
 				echo $post_type_obj->label
 				//print_R($post_type_obj);*/
        		if (!empty($post_type_conf) && !empty($_GET['post_type'])) {
        			$post_type_str_arr = array();
        			foreach ($post_type_conf as $value) {
        				$post_type_str_arr[$value['post_code']] = $value['post_str'];
        			}
        			$post_type_str = $post_type_str_arr[$_GET['post_type']];
        			?>
        			<a href="<?php echo home_url() ?>" >首页</a>-><?php echo $post_type_str ?>
        			<?php 
        		}

 				?>
 				
 				<?php 
        }
    	 	
 		?>
 		
		<?php 
		require $html;
		?>
    </td>
  </tr>
</table>

<?php get_footer(); ?>


<?php

}
?>