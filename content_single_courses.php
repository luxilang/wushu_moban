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

图片：<img  src="<?php echo $img_url ?>" /><br />

课程简介: <?php echo get_post_meta($post_id,'_id_tinymce_kcjj',true); ?>  <br /><hr />
学员保障: <?php echo get_post_meta($post_id,'_id_tinymce_xybz',true); ?>  <br /><hr />
课程评价:<?php echo get_post_meta($post_id,'_id_tinymce_kcpj',true); ?>  <br /><hr />
扩展阅读:<?php echo get_post_meta($post_id,'_id_tinymce_kzyd',true); ?>  <br /><hr />
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
