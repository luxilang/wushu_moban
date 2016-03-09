<style>
.lupage{ margin-top:20px;}
.lupage a{ float:left; border:1px solid #eeeded; padding: 5px 10px; line-height: normal; margin-right:5px;}
.lupage select{ height:28px;}
.lupage .c_ff78001{ background-color:#337ab7; color:#FFF;}
</style>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="20" style="font-size:16px">
<?php

$page_size = 12;
$curr_url = "?cat=1"; 
$page_size = !empty($page_size) ? $page_size : 10;
$rs = $wpdb->get_results("select count(*) as num from wp_posts where  post_status = 'publish'  and  post_type = 'post' and  flag = 1   ");
$count = !empty($rs[0]->num) ? $rs[0]->num : 0;
if (isMobile()) {
	$lupage = new lupage ( $count, $page_size, $curr_url,2);
}else{
	$lupage = new lupage ( $count, $page_size, $curr_url);
}

$rs = $wpdb->get_results("select * from wp_posts where  post_status = 'publish'  and  post_type = 'post' and  flag = 1  order by ID desc   limit  ".$lupage->startId ()." ,  {$page_size} " );
if (!empty($rs)) {
	
	foreach ($rs as $key => $rs_o) {
		
		?>
		
  <tr>
    <td width="79%" height="40"><a href="<?php echo get_permalink($rs_o->ID); ?>"><?php echo $rs_o->post_title?></a></td>
    <td width="21%" align="right"><?php echo $rs_o->post_date; ?></td>
  </tr>

<?php 		
	}
}
?>

  <tr>
    <td height="53" colspan="2" align="center" class='lupage'>
	<?php 
	if (isMobile()) {
	echo $lupage->mobile_out_page ();
}else{
	echo $lupage->out_page ();
}

?>
</td>
  </tr>
</table>

