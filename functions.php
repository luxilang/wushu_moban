<?php
//require get_template_directory() . '/ajax.php';
function get_current_archive_link( $paged = true ) { 
       $link = false; 
  
       if ( is_front_page() ) { 
               $link = home_url( '/' ); 
       } else if ( is_home() && "page" == get_option('show_on_front') ) { 
               $link = get_permalink( get_option( 'page_for_posts' ) ); 
       } else if ( is_tax() || is_tag() || is_category() ) { 
               $term = get_queried_object(); 
               $link = get_term_link( $term, $term->taxonomy ); 
       } else if ( is_post_type_archive() ) { 
               $link = get_post_type_archive_link( get_post_type() ); 
       } else if ( is_author() ) { 
               $link = get_author_posts_url( get_query_var('author'), get_query_var('author_name') ); 
       } else if ( is_archive() ) { 
               if ( is_date() ) { 
                       if ( is_day() ) { 
                               $link = get_day_link( get_query_var('year'), get_query_var('monthnum'), get_query_var('day') ); 
                       } else if ( is_month() ) { 
                               $link = get_month_link( get_query_var('year'), get_query_var('monthnum') ); 
                       } else if ( is_year() ) { 
                               $link = get_year_link( get_query_var('year') ); 
                       }                                                 
               } 
       } 
  
       if ( $paged && $link && get_query_var('paged') > 1 ) { 
               global $wp_rewrite; 
               if ( !$wp_rewrite->using_permalinks() ) { 
                       $link = add_query_arg( 'paged', get_query_var('paged'), $link ); 
               } else { 
                       $link = user_trailingslashit( trailingslashit( $link ) . trailingslashit( $wp_rewrite->pagination_base ) . get_query_var('paged'), 'archive' ); 
               } 
       } 
       return $link; 
}

add_filter( 'wp_revisions_to_keep', 'specs_wp_revisions_to_keep', 10, 2 );
function specs_wp_revisions_to_keep( $num, $post ) {
    return 0;
}

/**
 * 注册 留言菜单项
 */
add_action('admin_menu', 'add_yuyue_menu');     
function add_yuyue_menu() {

	add_menu_page( '预约菜单', '预约菜单', 'administrator', 'yuyue', 'yuyue', '', 51);

}

function  yuyue() {
  	?>
  	<iframe  frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes" id="content" name="content" src="/wp-admin/custom_admin/index.php" style="width:80%; height:800px; border:none;"></iframe>
  	<?php 
}


require get_template_directory() . '/include/metaboxclass.php';
require get_template_directory() . '/include/simple-term-meta.php';
require get_template_directory() . '/include/class-taxonomy-feild.php';
require get_template_directory() . '/include/optionclass.php';
require get_template_directory() . '/include/import_export.php';
include_once('conf.php'); 
include_once 'custom_post_types.php';
include_once 'layout.php';

function hbns_register_p2p_relationships() {
	if ( !function_exists( 'p2p_register_connection_type' ) )
		return;

	p2p_register_connection_type( array(
		'name' => 'courses_to_students',
		'from' => 'courses',
		'to' => 'students',
		'sortable' => 'from',
		'admin_column' => 'any',
		'admin_box' => array(
			'show' => 'any',
			'context' => 'advanced',
			),
		'cardinality' => 'many-to-many',
			/*
		'fields' => array(
			'description' => 'Description',
			),*/
		) );
	p2p_register_connection_type( array(
		'name' => 'courses_to_teachers',
		'from' => 'courses',
		'to' => 'teachers',
		'sortable' => 'from',
		'admin_column' => 'any',
		'admin_box' => array(
			'show' => 'any',
			'context' => 'advanced',
			),
		'cardinality' => 'many-to-many',
			/*
		'fields' => array(
			'description' => 'Description',
			),*/
		) );
		p2p_register_connection_type( array(
		'name' => 'teachers_to_students',
		'from' => 'teachers',
		'to' => 'students',
		'sortable' => 'from',
		'admin_column' => 'any',
		'admin_box' => array(
			'show' => 'any',
			'context' => 'advanced',
			),
		'cardinality' => 'many-to-many',
			/*
		'fields' => array(
			'description' => 'Description',
			),*/
		) );
}
 
add_action( 'wp_loaded', 'hbns_register_p2p_relationships' );


//页面的数据模型

//取得 自定义分类子分类置顶信息
/**
 * 
 * Enter description here ...
 * @param unknown_type $post_type  courses
 * @param unknown_type $post_type_class 少年组
 * @param unknown_type $meta_key _is_top
 */
function custom_type_class_meta($post_type,$post_type_class,$meta_key) {

	global  $wpdb;
	$sql = "
	SELECT * FROM  wp_postmeta 
	LEFT JOIN wp_posts ON  wp_posts.ID = wp_postmeta.post_id
	LEFT JOIN  
	wp_term_relationships  ON 
	wp_term_relationships.object_id  = wp_posts.ID
	LEFT JOIN
	wp_term_taxonomy
	ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
	LEFT JOIN 
	wp_terms 
	ON  wp_terms.term_id = wp_term_taxonomy.term_id
	WHERE wp_postmeta.meta_key = '_is_top' AND wp_postmeta.meta_value = 1 AND wp_posts.post_type = '{$post_type}' AND wp_terms.name = '{$post_type_class}'
	order by wp_posts.ID desc
	limit 3
		";
	$rs = $wpdb->get_results($sql);
	//置顶封面
	if (($post_type == '_is_top' && count($rs) < 3 ) || empty($rs) ) {
			$sql = "
			SELECT * FROM  wp_posts 
			LEFT JOIN  
			wp_term_relationships  ON 
			wp_term_relationships.object_id  = wp_posts.ID
			LEFT JOIN
			wp_term_taxonomy
			ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
			LEFT JOIN 
			wp_terms 
			ON  wp_terms.term_id = wp_term_taxonomy.term_id
			WHERE  wp_posts.post_type = '{$post_type}' AND wp_terms.name = '{$post_type_class}'
			order by wp_posts.ID desc
			limit 3
				";
			
			$rs = $wpdb->get_results($sql);
	}

	return $rs;
	
}
/**
 * 
 * Enter description here ...
 * @param unknown_type $tag_name  dong_wushu 武术 
 * @param unknown_type $slug   xlhx 训练花絮
 * @param unknown_type $post_type students
 */
function custom_type_tag($lei,$post_type)
{
	global  $wpdb;
	
	if (!empty($lei)) {
		$lei_arr = explode(',', $lei);
	}
	$lei_c = count($lei_arr);
	
	if ($lei_c  < 0 ) return false;

	$sql0 = " 1=1 "; 
	if ($lei_c == 1)
	{
		$sql0 .= " and wp_terms.slug = '{$lei}' ";
	}else{
		$lei_arr_news = array();
		foreach ($lei_arr as $key => $value) {
			$lei_arr_news[] = "  wp_terms.slug = '{$value}'  ";
		}
		$sql0 .= '  and ( '.join('  or ', $lei_arr_news).'   )  ';
	}

	$sql = "SELECT DISTINCT wp_posts.ID,wp_posts.* FROM wp_posts
		LEFT JOIN  
		wp_term_relationships  ON 
		wp_term_relationships.object_id  = wp_posts.ID
		LEFT JOIN
		wp_term_taxonomy
		ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
		LEFT JOIN 
		wp_terms 
		ON  wp_terms.term_id = wp_term_taxonomy.term_id
		WHERE {$sql0 } AND wp_posts.post_type = '{$post_type}' ";
	echo $sql;	
	$rs = $wpdb->get_results($sql);
	return $rs;
}





























