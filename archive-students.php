<?php
/*
Template Name: 学员信息列表模板  
*/ 
get_header(); 
?>
<table width="100%" border="1">
  <tr>
    <td width="8%" height="420" align="center"><?php echo get_template_part('archive','left');?></td>
    <td width="92%" align="left" valign="top">
  <?php

echo get_template_part('fun','archive');
echo_nav_list_info('students')
?>
	 </td>
  </tr>
</table>

<?php get_footer(); ?>
