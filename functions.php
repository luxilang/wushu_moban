<?php

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





























