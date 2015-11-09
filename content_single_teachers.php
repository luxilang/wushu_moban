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
$img_url = get_post_meta($post_id,'_id_upload_teachers',true); //_id_upload即配置数据中的id值，获取的值实际为图片url地址
//输出<img>标签
?>

图片：<img  src="<?php echo $img_url ?>" /><br />

获奖经历: <?php echo get_post_meta($post_id,'_id_tinymce_hjjl',true); ?>  <br /><hr />
学员中心: <?php echo get_post_meta($post_id,'_id_tinymce_xyzx',true); ?>  <br /><hr />
教学成果:<?php echo get_post_meta($post_id,'_id_tinymce_jxcg',true); ?>  <br /><hr />
课堂展示：<?php

//echo get_post_meta($post_id,'_id_tinymce_ktzs',true); ?>  <br /><hr />
扩展阅读:<?php echo get_post_meta($post_id,'_id_tinymce_kzyd',true); ?>  <br /><hr />


<?php 
//调用相关的  学员信息
$connected = new WP_Query( array(
  'connected_type' => 'teachers_to_students',
  'connected_items' => get_queried_object(),
  'nopaging' => true,
) );

// Display connected pages
if ( $connected->have_posts() ) :
?>
<h3>课堂展示</h3>
<ul>
<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
    <li>
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    
    
    <img  src="<?php echo get_post_meta(get_the_ID(),'_id_upload_students',true); ?>" width="200" height="200"  /><br />
    </li>
<?php endwhile; ?>
</ul>

<?php 
// Prevent weirdness
wp_reset_postdata();

endif;
?>

我要体验
