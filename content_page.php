<?php

if (empty($post->ID))  die(' no post');

?>
首页-&gt;<a href="<?php the_permalink() ?>"><?php echo $post->post_title;?></a>

<?php
		   
$connected = new WP_Query( array(
  'connected_type' => 'posts_to_pages',
  'connected_items' => get_queried_object(),
  'nopaging' => true,
) );

// Display connected pages
if ( $connected->have_posts() ) :
?>
<h3>Related pages:</h3>
<ul>
<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; ?>
</ul>

<?php 
// Prevent weirdness
wp_reset_postdata();

endif;
		    
		echo $post->post_content;
		?>
