<?php
$post_id = $post->ID; //首选需要获取文章id
 		$post_type = get_post_type();
 		$post_type_obj = get_post_type_object(get_post_type());

 		?>
 		<a href="<?php echo home_url() ?>" >首页</a>-><a href="<?php echo home_url() ?>?post_type=<?php echo $post_type ?>"   ><?php echo $post_type_obj->label ?></a>-><?php echo get_the_title() ?>
 		<br />


标题:  <?php echo $post->post_title ?> <br />
摘要:  <?php echo $post->post_excerpt ?> <br />
摘要:  <?php echo $post->post_content ?> <br />
<?php
$img_url = get_post_meta($post_id,'_id_upload_courses',true); 

?>

图片1：<img  src="<?php echo $img_url ?>" /><br />
<?php 
$ashu_courses_tab_arr = get_option('ashu_courses_tab');
$courses_tab_ini = trim($ashu_courses_tab_arr['_courses_tab_ini']);


	if (!empty($courses_tab_ini)) {
		
			$courses_tab_ini_arr = array_filter(explode("\r\n", $courses_tab_ini));
			if (!empty($courses_tab_ini_arr)) {
				foreach ($courses_tab_ini_arr as $key => $value) {
					if (!empty($value)) {
						list($tab_option_name,$tab_option_id,$tab_option_desc) =  explode("|", $value);
						
						echo "{$tab_option_name}:".get_post_meta($post_id,$tab_option_id,true)."<br /><hr />";
					}
				
				}
			}
		
		}
?>

<?php 
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
