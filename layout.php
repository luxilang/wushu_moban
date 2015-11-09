<?php

	
/*
Template Name: 信息布局模板  
*/ 
function echo_layout($html)
{
	global $post;
get_header();

?>

<table width="100%" border="1">
  <tr>
    <td width="8%" height="420" align="left" valign="top"><?php echo get_template_part('layout','left');?></td>
    <td width="92%" align="left" valign="top">
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