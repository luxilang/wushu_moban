<?php
	global $wpdb;
	if($_POST)
	{
		$wpdb->update( 'wp_article_cf', array( 'cfvalue' => $_POST['cfvalue'] ), array( 'cfname' => 'pub_num' ));
		echo "<script>alert('更新成功！');window.history.go(-1);</script>"; 
	}
	
	$split_tj_num1    = intval( $wpdb->get_var("SELECT COUNT(*) FROM  wp_posts  WHERE  flag  = 0  AND post_status = 'publish'  AND  post_type = 'post' and is_split_title = 0") );

	$split_tj_num2    = intval( $wpdb->get_var("SELECT COUNT(*)  FROM wp_article WHERE flag = 0 AND title_id = 0  ") );
	$split_tj_num3    = intval( $wpdb->get_var("SELECT COUNT(*)  FROM wp_article1 WHERE flag = 0 AND title_id = 0 ") );
	
	$wp_article_cf_rs  = $wpdb->get_row("SELECT * FROM wp_article_cf  WHERE cfname = 'pub_num' "); 
	
	$curr_cfvalue =$wp_article_cf_rs->cfvalue;

?>
<table width="100%" border="0" cellspacing="10" cellpadding="0">
  <tr>
    <td height="49" align="center"><strong>统计</strong></td>
    <td height="49" align="center"><strong>配置</strong></td>
  </tr>
  <tr>
    <td width="54%" height="388" align="left" valign="top"><table width="100%" border="1" cellspacing="0" cellpadding="0">
    
      <tr>
        <td width="44%" height="40" align="right">【使用导入标题】未使用的标题数：</td>
        <td width="56%"><?php echo $split_tj_num1 ?></td>
      </tr>
      <tr>
        <td height="32" align="right">【使用导入标题】未合成的文章数：</td>
        <td><?php echo $split_tj_num2 ?></td>
      </tr>

      <tr>
        <td height="34" align="right">【使用书籍标题】拆分书籍未发布的文章数：</td>
        <td><?php echo $split_tj_num3 ?></td>
      </tr>
    </table></td>
    
    <td width="46%" align="left" valign="top">
    <form action="" method="post" >
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="40%" align="right">每次发布文章：</td>
        <td width="60%"><input type="text" name="cfvalue"  value="<?php echo $curr_cfvalue ?>" id="cfvalue" />
          篇</td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td><input type="submit" name="button" id="button" value="更新" /></td>
      </tr>
     
    </table></form></td>
  </tr>
</table>
