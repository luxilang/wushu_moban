<?php

if (empty($post->ID))  die(' no post');

?>
首页-&gt;<a href="<?php the_permalink() ?>"><?php echo $post->post_title;?></a>

<?php 
if ( have_posts() ) :
?>
<?php while ( have_posts() ) : the_post(); ?>
 
 	<?php the_content();?>
 
<?php endwhile; ?>
  一些HTML
<?php else : ?>
另一些HTML
<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>