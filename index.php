<?php
get_header();

?>
<table width="100%" border="1">
  <tr>
    <td>我们提供各年龄段的武术课程</td>
  </tr>
  <tr>
    <td height="69">
    <?php 
    
    function get_tab_info($post_type_class,$post_type) {
    	 global  $wpdb;
    
	    $sql = "
		SELECT wp_posts.* FROM wp_posts
		LEFT JOIN  
		wp_term_relationships  ON 
		wp_term_relationships.object_id  = wp_posts.ID
		LEFT JOIN
		wp_term_taxonomy
		ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
		LEFT JOIN 
		wp_terms 
		ON  wp_terms.term_id = wp_term_taxonomy.term_id
		WHERE wp_terms.name = '{$post_type_class}' 
		LIMIT 3
	    ";
	    //AND wp_term_taxonomy.taxonomy = '{$post_type}' 
		$rs = $wpdb->get_results($sql);
		?>
         <div style=" border:1px solid #F00">
        <?php echo $post_type_class ?>  <hr />
        <?php 
	
		if (!empty($rs)) {
			foreach ($rs as $key => $rs_o) {
				?>
               
				标题:<?php echo  $rs_o->post_title ?><br />
             	摘要:<?php echo $rs_o->post_excerpt ?><br />
                图片:<?php $img_url = get_post_meta($rs_o->ID,'_id_upload_courses',true); ?>
                <img  src="<?php echo $img_url ?>" width="200" height="200" />
                <br />;
		
                
		
                <?php
			}
		}
		
		?>
        </div>
        <?php
    }
   
    get_tab_info('少儿组','courses_type');
	 get_tab_info('少年组','courses_type');
	  get_tab_info('成人组','courses_type');
	   get_tab_info('1对1私教课程','courses_type');
    ?>
    
    </td>
  </tr>
</table>
<table width="100%" border="1">
  <tr>
    <td>家长选择武术世家的理由</td>
  </tr>
  <tr>
    <td height="69"><?php 

			echo $content = get_post('161')->post_content;   
    ?></td>
  </tr>
</table>

<table width="100%" border="1">
  <tr>
    <td>我们卓越的教练团队</td>
  </tr>
  <tr>
    <td height="69"><?php 

			echo $content = get_post('163')->post_content;   
    ?></td>
  </tr>
</table>
<table width="100%" border="1">
  <tr>
    <td>来自家长的声音</td>
  </tr>
  <tr>
    <td height="69">
    <?php 
			echo $content = get_post('165')->post_content;   
    ?></td>
  </tr>
</table>
<?php
get_footer();

?>
