<?php
/*
Template Name: 课程列表模板  
*/ 
get_header(); 

$sticky = get_option( 'sticky_posts' );
print_R($sticky);exit();
?>
<table width="100%" border="1">
  <tr>
    <td width="8%" height="420" align="center"><?php echo get_template_part('archive','left');?></td>
    <td width="92%" align="left" valign="top">
      <?php

echo get_template_part('fun','archive');
echo_nav_list_info('courses');
?>
    
    </td>
  </tr>
</table>

<?php get_footer(); ?>
