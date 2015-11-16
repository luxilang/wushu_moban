 <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="class-title">
            <label><?php echo $post->post_title;?></label>
            <ol class="breadcrumb">
              <li><a href="/">首页</a></li>
              <li class="active"><?php echo $post->post_title;?></li>
            </ol>
          </div>
        </div>
 </div>


<?php 
if ( have_posts() ) :
?>
<?php while ( have_posts() ) : the_post(); ?>
 
 	<?php the_content();?>
 
<?php endwhile; ?>

<?php else : ?>

<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>