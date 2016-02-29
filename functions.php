<?php

remove_filter ('the_content', 'wpautop');

remove_filter ('comment_text', 'wpautop');
function remove_screen_options(){ return false;}
add_filter('screen_options_show_screen', 'remove_screen_options');
add_filter( 'contextual_help', 'wpse50723_remove_help', 999, 3 );
function wpse50723_remove_help($old_help, $screen_id, $screen){
$screen->remove_help_tabs();
return $old_help;
}


add_filter('show_admin_bar','__return_false'); 
class Disable_Google_Fonts{
    public function __construct(){
        add_filter('gettext_with_context',array($this,'disable_open_sans'),888,4);
    }
    public function disable_open_sans($translations,$text,$context,$domain ){
        if ('Open Sans font: on or off' == $context && 'on' == $text){
            $translations = 'off';
        }
        return $translations;
    }
}
$disable_google_fonts = new Disable_Google_Fonts;

/**
function dmeng_get_https_avatar($avatar) {
    //~ 替换为 https 的域名
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "secure.gravatar.com", $avatar);
    //~ 替换为 https 协议
    $avatar = str_replace("http://", "https://", $avatar);
    return $avatar;
}
add_filter('get_avatar', 'dmeng_get_https_avatar');
*/
function get_ssl_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');
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


add_action('admin_menu', 'add_yuyue_menu');     
function add_yuyue_menu() {

	add_menu_page( '体验预约', '体验预约', 'administrator', 'yuyue', 'yuyue', '', 51);

}
/*function  yuyue(){
	 include_once 'yuyue.php';
}*/
function  yuyue() {
  	echo '<iframe  frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes" id="content" name="content" src="/wp-admin/custom_admin/index.php" style="width:80%; height:800px; border:none;"></iframe>';  	 
}

/**
 * 
 */
add_action('admin_menu', 'add_titledao_menu');     
function add_titledao_menu() {

	add_menu_page( '文章标题导入', '文章标题导入', 'administrator', 'titledao', 'titledao', '', 52);

}
function titledao() {
	  	echo '<iframe  frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes" id="content" name="content" src="/api/titledao.php" style="width:80%; height:800px; border:none;"></iframe>';  	 

}


require get_template_directory() . '/include/metaboxclass.php';
require get_template_directory() . '/include/simple-term-meta.php';
require get_template_directory() . '/include/class-taxonomy-feild.php';
require get_template_directory() . '/include/optionclass.php';
require get_template_directory() . '/include/import_export.php';
require get_template_directory() . '/conf.php';
require get_template_directory() . '/custom_post_types.php';
require get_template_directory() . '/layout.php';
require get_template_directory() . '/class_lu.php'; 
/***
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
			
		//'fields' => array(
		//	'description' => 'Description',
		//	),
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
			
		//'fields' => array(
		//	'description' => 'Description',
			//),
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
			
		//'fields' => array(
			//'description' => 'Description',
			//),
		) );
}
 
add_action( 'wp_loaded', 'hbns_register_p2p_relationships' );
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

function get_bendi_wenzhang($rs) {
	$rs_o = $rs[0];
	$file_path = $rs_o->file_path;
	$html_url = 'http://'.$_SERVER['HTTP_HOST'].'/'.$file_path;
	
	$html =  file_get_contents($html_url); 
	
	$host = str_replace(strrchr($html_url, '/'),'' , $html_url).'/';
	
	$html = mb_convert_encoding($html, "UTF-8", "GB2312");
	$html = preg_replace ( "/<img.+?src=\'(.+?)\'.+?>/", '<img src="' . $host . '\1" />', $html );
	return $html;
}

