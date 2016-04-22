<?php
add_filter('xmlrpc_enabled', '__return_false');
function wp_hide_nag() {
	remove_action( 'admin_notices', 'update_nag', 3 );
}
add_action('admin_menu','wp_hide_nag');
function annointed_admin_bar_remove() {
	global $wp_admin_bar;
	/* Remove their stuff */
	$wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);


function remove_menus() {
	global $menu;
	$restricted = array(
	__('Dashboard'),
	//__('Posts'),
	__('Media'),
	__('Links'),
	//__('Pages'),
	__('Appearance'),
	__('Tools'),
	//__('Users'),
	__('Settings'),
	//__('Comments'),
	//__('Plugins')
	);
	end ($menu);
	while (prev($menu)){
	$value = explode(' ',$menu[key($menu)][0]);
	if(strpos($value[0], '<') === FALSE) {
	if(in_array($value[0] != NULL ? $value[0]:"" , $restricted)){
	unset($menu[key($menu)]);
	}
	}else {
	$value2 = explode('<', $value[0]);
	if(in_array($value2[0] != NULL ? $value2[0]:"" , $restricted)){
	unset($menu[key($menu)]);
	}
	}
	}
}
if (is_admin()){
// 屏蔽左侧菜单
add_action('admin_menu', 'remove_menus');
}
function example_remove_dashboard_widgets() {
	// Globalize the metaboxes array, this holds all the widgets for wp-admin
	global $wp_meta_boxes;
	// 以下这一行代码将删除 "快速发布" 模块
	unset ( $wp_meta_boxes ['dashboard'] ['side'] ['core'] ['dashboard_quick_press'] );
	// 以下这一行代码将删除 "引入链接" 模块
	unset ( $wp_meta_boxes ['dashboard'] ['normal'] ['core'] ['dashboard_incoming_links'] );
	// 以下这一行代码将删除 "插件" 模块
	unset ( $wp_meta_boxes ['dashboard'] ['normal'] ['core'] ['dashboard_plugins'] );
	// 以下这一行代码将删除 "近期评论" 模块
	unset ( $wp_meta_boxes ['dashboard'] ['normal'] ['core'] ['dashboard_recent_comments'] );
	// 以下这一行代码将删除 "近期草稿" 模块
	unset ( $wp_meta_boxes ['dashboard'] ['side'] ['core'] ['dashboard_recent_drafts'] );
	// 以下这一行代码将删除 "WordPress 开发日志" 模块
	unset ( $wp_meta_boxes ['dashboard'] ['side'] ['core'] ['dashboard_primary'] );
	// 以下这一行代码将删除 "其它 WordPress 新闻" 模块
	unset ( $wp_meta_boxes ['dashboard'] ['side'] ['core'] ['dashboard_secondary'] );
	// 以下这一行代码将删除 "概况" 模块
	unset ( $wp_meta_boxes ['dashboard'] ['normal'] ['core'] ['dashboard_right_now'] );
	
	unset ( $wp_meta_boxes ['dashboard'] ['normal'] ['core'] ['dashboard_activity'] );
}
add_action ( 'wp_dashboard_setup', 'example_remove_dashboard_widgets' );

remove_filter ( 'the_content', 'wpautop' );

remove_filter ( 'comment_text', 'wpautop' );
function remove_screen_options() {
	return false;
}
add_filter ( 'screen_options_show_screen', 'remove_screen_options' );
add_filter ( 'contextual_help', 'wpse50723_remove_help', 999, 3 );
function wpse50723_remove_help($old_help, $screen_id, $screen) {
	$screen->remove_help_tabs ();
	return $old_help;
}

add_filter ( 'show_admin_bar', '__return_false' );
class Disable_Google_Fonts {
	public function __construct() {
		add_filter ( 'gettext_with_context', array ($this, 'disable_open_sans' ), 888, 4 );
	}
	public function disable_open_sans($translations, $text, $context, $domain) {
		if ('Open Sans font: on or off' == $context && 'on' == $text) {
			$translations = 'off';
		}
		return $translations;
	}
}
$disable_google_fonts = new Disable_Google_Fonts ();

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
	$avatar = preg_replace ( '/.*\/avatar\/(.*)\?s=([\d]+)&.*/', '<img src="https://secure.gravatar.com/avatar/$1?s=$2" height="$2" width="$2">', $avatar );
	return $avatar;
}
add_filter ( 'get_avatar', 'get_ssl_avatar' );
//require get_template_directory() . '/ajax.php';
function get_current_archive_link($paged = true) {
	$link = false;
	
	if (is_front_page ()) {
		$link = home_url ( '/' );
	} else if (is_home () && "page" == get_option ( 'show_on_front' )) {
		$link = get_permalink ( get_option ( 'page_for_posts' ) );
	} else if (is_tax () || is_tag () || is_category ()) {
		$term = get_queried_object ();
		$link = get_term_link ( $term, $term->taxonomy );
	} else if (is_post_type_archive ()) {
		$link = get_post_type_archive_link ( get_post_type () );
	} else if (is_author ()) {
		$link = get_author_posts_url ( get_query_var ( 'author' ), get_query_var ( 'author_name' ) );
	} else if (is_archive ()) {
		if (is_date ()) {
			if (is_day ()) {
				$link = get_day_link ( get_query_var ( 'year' ), get_query_var ( 'monthnum' ), get_query_var ( 'day' ) );
			} else if (is_month ()) {
				$link = get_month_link ( get_query_var ( 'year' ), get_query_var ( 'monthnum' ) );
			} else if (is_year ()) {
				$link = get_year_link ( get_query_var ( 'year' ) );
			}
		}
	}
	
	if ($paged && $link && get_query_var ( 'paged' ) > 1) {
		global $wp_rewrite;
		if (! $wp_rewrite->using_permalinks ()) {
			$link = add_query_arg ( 'paged', get_query_var ( 'paged' ), $link );
		} else {
			$link = user_trailingslashit ( trailingslashit ( $link ) . trailingslashit ( $wp_rewrite->pagination_base ) . get_query_var ( 'paged' ), 'archive' );
		}
	}
	return $link;
}

add_filter ( 'wp_revisions_to_keep', 'specs_wp_revisions_to_keep', 10, 2 );
function specs_wp_revisions_to_keep($num, $post) {
	return 0;
}

add_action ( 'admin_menu', 'add_yuyue_menu' );
function add_yuyue_menu() {
	
	add_menu_page ( '体验预约', '体验预约', 'administrator', 'yuyue', 'yuyue', '', 51 );

}
/*function  yuyue(){
	 include_once 'yuyue.php';
}*/
function yuyue() {
	echo '<iframe  frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes" id="content" name="content" src="/wp-admin/custom_admin/index.php" style="width:80%; height:800px; border:none;"></iframe>';
}

/**
 * 
 */
add_action ( 'admin_menu', 'add_titledao_menu' );
function add_titledao_menu() {
	
	add_menu_page ( '文章标题导入', '文章标题导入', 'administrator', 'titledao', 'titledao', '', 52 );

}
function titledao() {
	echo '<iframe  frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes" id="content" name="content" src="/api/titledao.php" style="width:80%; height:800px; border:none;"></iframe>';

}

require get_template_directory () . '/include/metaboxclass.php';
require get_template_directory () . '/include/simple-term-meta.php';
require get_template_directory () . '/include/class-taxonomy-feild.php';
require get_template_directory () . '/include/optionclass.php';
require get_template_directory () . '/include/import_export.php';
require get_template_directory () . '/conf.php';
require get_template_directory () . '/custom_post_types.php';
require get_template_directory () . '/layout.php';
require get_template_directory () . '/class_lu.php';
require get_template_directory () . '/curl.php';
require get_template_directory () . '/class.phpmailer.php';
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

function custom_type_class_meta($post_type, $post_type_class, $meta_key) {
	
	global $wpdb;
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
	$rs = $wpdb->get_results ( $sql );
	//置顶封面
	if (($post_type == '_is_top' && count ( $rs ) < 3) || empty ( $rs )) {
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
		
		$rs = $wpdb->get_results ( $sql );
	}
	
	return $rs;

}

function custom_type_tag($lei, $post_type) {
	global $wpdb;
	
	if (! empty ( $lei )) {
		$lei_arr = explode ( ',', $lei );
	}
	$lei_c = count ( $lei_arr );
	
	if ($lei_c < 0)
		return false;
	
	$sql0 = " 1=1 ";
	if ($lei_c == 1) {
		$sql0 .= " and wp_terms.slug = '{$lei}' ";
	} else {
		$lei_arr_news = array ();
		foreach ( $lei_arr as $key => $value ) {
			$lei_arr_news [] = "  wp_terms.slug = '{$value}'  ";
		}
		$sql0 .= '  and ( ' . join ( '  or ', $lei_arr_news ) . '   )  ';
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
	$rs = $wpdb->get_results ( $sql );
	return $rs;
}

function get_bendi_wenzhang($rs) {
	$rs_o = $rs [0];
	$file_path = $rs_o->file_path;
	$html_url = 'http://' . $_SERVER ['HTTP_HOST'] . '/' . $file_path;
	
	$html = file_get_contents ( $html_url );
	
	$host = str_replace ( strrchr ( $html_url, '/' ), '', $html_url ) . '/';
	
	$html = mb_convert_encoding ( $html, "UTF-8", "GB2312" );
	if (isMobile ()) {
		$html = preg_replace ( "/<img.+?src=\'(.+?)\'.+?>/", '<img width="100%" src="' . $host . '\1" />', $html );
	} else {
		$html = preg_replace ( "/<img.+?src=\'(.+?)\'.+?>/", '<img src="' . $host . '\1" />', $html );
	}
	
	return $html;
}

function isMobile() {
	// 如果有HTTP_X_WAP_PROFILE则一定是移动设备
	if (isset ( $_SERVER ['HTTP_X_WAP_PROFILE'] )) {
		return true;
	}
	// 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
	if (isset ( $_SERVER ['HTTP_VIA'] )) {
		// 找不到为flase,否则为true
		return stristr ( $_SERVER ['HTTP_VIA'], "wap" ) ? true : false;
	}
	// 脑残法，判断手机发送的客户端标志,兼容性有待提高
	if (isset ( $_SERVER ['HTTP_USER_AGENT'] )) {
		$clientkeywords = array ('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile' );
		// 从HTTP_USER_AGENT中查找手机浏览器的关键字
		if (preg_match ( "/(" . implode ( '|', $clientkeywords ) . ")/i", strtolower ( $_SERVER ['HTTP_USER_AGENT'] ) )) {
			return true;
		}
	}
	// 协议法，因为有可能不准确，放到最后判断
	if (isset ( $_SERVER ['HTTP_ACCEPT'] )) {
		// 如果只支持wml并且不支持html那一定是移动设备
		// 如果支持wml和html但是wml在html之前则是移动设备
		if ((strpos ( $_SERVER ['HTTP_ACCEPT'], 'vnd.wap.wml' ) !== false) && (strpos ( $_SERVER ['HTTP_ACCEPT'], 'text/html' ) === false || (strpos ( $_SERVER ['HTTP_ACCEPT'], 'vnd.wap.wml' ) < strpos ( $_SERVER ['HTTP_ACCEPT'], 'text/html' )))) {
			return true;
		}
	}
	return false;
}

function set_token() {
	$_SESSION ['token'] = md5 ( microtime ( true ) );
}

function valid_token() {
	$return = $_REQUEST ['token'] === $_SESSION ['token'] ? true : false;
	set_token ();
	return $return;
} 

function m_subtext($text, $length)
{
	if(mb_strlen($text, 'utf8') > $length)
	{
	return mb_substr($text, 0, $length, 'utf8').'...';
	}
	else
	{
	return $text;
	}
}



function menu_split(){   
    add_menu_page( '拆分书籍配置', '拆分书籍配置', 'edit_themes', 'menu_split','display_menu_split','',64);   
}   
 
add_action('admin_menu', 'menu_split');   

function display_menu_split() {
	include_once ( 'menu_split.php' );
}

