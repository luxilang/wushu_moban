<?php
get_header();
if (empty($post->ID))  die(' no post');

?>


<table width="100%" border="1">
  <tr>
    <td width="8%" height="420" align="center"><?php echo get_template_part('archive','left');?></td>
    <td width="92%" align="left" valign="top">

		<table width="100%" border="1">
		  <tr>
		    <td width="59%"><?php echo $post->post_title;?></td>
		    <td width="41%" align="right">首页-&gt;<a href="<?php the_permalink() ?>"><?php echo $post->post_title;?></a></td>
	      </tr>
		  <tr>
		    <td colspan="2"><?php 
		echo $post->post_content;
		?></td>
	      </tr>
      </table>
    
    </td>
  </tr>
</table>
<?php
get_footer();
?>