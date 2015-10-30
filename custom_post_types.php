<?php

add_action( 'init', 'custom_post_types' );
function custom_post_types()
{
	/**
	 * 课程
	 */
	$args = array(
		'labels' => array(
				'name' => '课程介绍',
				'singular_name' => '课程介绍',
				'menu_name' => '课程介绍',
				'name_admin_bar' => '课程介绍',
				'all_items' => '所有课程',
				'add_new' => '添加课程',
				'add_new_item' => '添加课程',
				'edit_item' => '编辑课程',
				'new_item' => '添加课程',
				'view_item' => '查看课程',
				'search_items' => '搜索课程',
				'not_found' =>  '未找到课程',
				'not_found_in_trash' => '回收站中没有课程',
				'parent_item_colon' => 'Parent Page',
			),
		'description' => '课程介绍',
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'has_archive' => true,
		'menu_position' => true,
		'menu_icon' => null,
		'hierarchical' => FALSE,
		'rewrite' => array( 'slug' => 'courses','with_front'=>false),
		'query_var' => true,
		'can_export' => true,
		'supports' => array( 'title','editor','excerpt','thumbnail' ),
		"taxonomies" => array( "post_tag" )
	);
	register_post_type( 'courses', $args );
	
	$labels = array(
		"name" => "课程分类",
		"label" => "课程分类",
		"menu_name" => "课程分类",
		"all_items" => "课程分类",
		"edit_item" => "编辑课程分类",
		"view_item" => "查看课程分类",
		"update_item" => "更新课程分类",
		"add_new_item" => "添加课程分类",
		"new_item_name" => "添加课程分类",
		"search_items" => "搜索课程分类",
		"popular_items" => "热门课程分类",
		);
	register_taxonomy(   
        'courses_type',   
        array('courses'),   
        array(   
            'hierarchical' => true,   
            'labels' => $labels,   
            'show_ui' => true,   
            'query_var' => true,   
            'rewrite' => array( 'slug' => 'courses_type' ),   
        )   
    ); 
    /**
     * 学员
     * 
     */
		$args = array(
		'labels' => array(
				'name' => '学员信息',
				'singular_name' => '学员信息',
				'menu_name' => '学员信息',
				'name_admin_bar' => '学员信息',
				'all_items' => '所有学员',
				'add_new' => '添加学员',
				'add_new_item' => '添加学员',
				'edit_item' => '编辑学员',
				'new_item' => '添加学员',
				'view_item' => '查看学员',
				'search_items' => '搜索学员',
				'not_found' =>  '未找到学员',
				'not_found_in_trash' => '回收站中没有学员',
				'parent_item_colon' => 'Parent Page',
			),
		'description' => '学员信息',
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'has_archive' => true,
		'menu_position' => true,
		'menu_icon' => null,
		'hierarchical' => FALSE,
		'rewrite' => true,
		'query_var' => true,
		'can_export' => true,
		'supports' =>array( 'title' ),
		"taxonomies" => array( "post_tag" )
	);
	register_post_type( 'students', $args );
	
	
	$labels = array(
		"name" => "学员分类",
		"label" => "学员分类",
		"menu_name" => "学员分类",
		"all_items" => "学员分类",
		"edit_item" => "编辑学员分类",
		"view_item" => "查看学员分类",
		"update_item" => "更新学员分类",
		"add_new_item" => "添加学员分类",
		"new_item_name" => "添加学员分类",
		"search_items" => "搜索学员分类",
		"popular_items" => "热门学员分类",
		);
	register_taxonomy(   
        'students_type',   
        array('students'),   
        array(   
            'hierarchical' => true,   
            'labels' => $labels,   
            'show_ui' => true,   
            'query_var' => true,   
            'rewrite' => array( 'slug' => 'students_type' ),   
        )   
    ); 
    
    /**
     * 教师信息
     * 
     */
		$args = array(
		'labels' => array(
				'name' => '教师信息',
				'singular_name' => '教师信息',
				'menu_name' => '教师信息',
				'name_admin_bar' => '教师信息',
				'all_items' => '所有教师',
				'add_new' => '添加教师',
				'add_new_item' => '添加教师',
				'edit_item' => '编辑教师',
				'new_item' => '添加教师',
				'view_item' => '查看教师',
				'search_items' => '搜索教师',
				'not_found' =>  '未找到教师',
				'not_found_in_trash' => '回收站中没有教师',
				'parent_item_colon' => 'Parent Page',
			),
		'description' => '教师信息',
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'has_archive' => true,
		'menu_position' => true,
		'menu_icon' => null,
		'hierarchical' => FALSE,
		'rewrite' => true,
		'query_var' => true,
		'can_export' => true,
		'supports' => array( 'title','editor','excerpt','thumbnail' ),
		"taxonomies" => array( "post_tag" )
	);
	register_post_type( 'teachers', $args );
	
	
	$labels = array(
		"name" => "教练分类",
		"label" => "教练分类",
		"menu_name" => "教练分类",
		"all_items" => "教练分类",
		"edit_item" => "编辑教练分类",
		"view_item" => "查看教练分类",
		"update_item" => "更新教练分类",
		"add_new_item" => "添加教练分类",
		"new_item_name" => "添加教练分类",
		"search_items" => "搜索教练分类",
		"popular_items" => "热门教练分类",
		);
	register_taxonomy(   
        'teachers_type',   
        array('teachers'),   
        array(   
            'hierarchical' => true,   
            'labels' => $labels,   
            'show_ui' => true,   
            'query_var' => true,   
            'rewrite' => array( 'slug' => 'teachers_type' ),   
        )   
    ); 
    
    
	
	
	$labels = array(
		"name" => "教练分类",
		"label" => "教练分类",
		"menu_name" => "教练分类",
		"all_items" => "教练分类",
		"edit_item" => "编辑教练分类",
		"view_item" => "查看教练分类",
		"update_item" => "更新教练分类",
		"add_new_item" => "添加教练分类",
		"new_item_name" => "添加教练分类",
		"search_items" => "搜索教练分类",
		"popular_items" => "热门教练分类",
		);
	register_taxonomy(   
        'teachers_type',   
        array('teachers'),   
        array(   
            'hierarchical' => true,   
            'labels' => $labels,   
            'show_ui' => true,   
            'query_var' => true,   
            'rewrite' => array( 'slug' => 'teachers_type' ),   
        )   
    ); 
    
     /**
     * 上课环境
     * 
     */
		$args = array(
		'labels' => array(
				'name' => '上课环境',
				'singular_name' => '上课环境',
				'menu_name' => '上课环境',
				'name_admin_bar' => '上课环境',
				'all_items' => '所有上课环境',
				'add_new' => '添加上课环境',
				'add_new_item' => '添加上课环境',
				'edit_item' => '编辑上课环境',
				'new_item' => '添加上课环境',
				'view_item' => '查看上课环境',
				'search_items' => '搜索上课环境',
				'not_found' =>  '未找到上课环境',
				'not_found_in_trash' => '回收站中没有上课环境',
				'parent_item_colon' => 'Parent Page',
				
			),
		'description' => '上课环境',
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'has_archive' => true,
		'menu_position' => true,
		'menu_icon' => null,
		'hierarchical' => FALSE,
		'rewrite' => true,
		'query_var' => true,
		'can_export' => true,
		'supports' =>array( 'title','editor' ),
		"taxonomies" => array( "post_tag" )
	);
	register_post_type( 'class_env', $args );
	
	$labels = array(
		"name" => "上课环境分类",
		"label" => "上课环境分类",
		"menu_name" => "上课环境分类",
		"all_items" => "上课环境分类",
		"edit_item" => "编辑上课环境分类",
		"view_item" => "查看上课环境分类",
		"update_item" => "更新上课环境分类",
		"add_new_item" => "添加上课环境分类",
		"new_item_name" => "添加上课环境分类",
		"search_items" => "搜索上课环境分类",
		"popular_items" => "热门上课环境分类",
		);
	register_taxonomy(   
        'class_env_type',   
        array('class_env'),   
        array(   
            'hierarchical' => true,   
            'labels' => $labels,   
            'show_ui' => true,   
            'query_var' => true,   
            'rewrite' => array( 'slug' => 'class_env_type' ),   
        )   
    ); 
	
  /**
     * 上课时间
     * 
     */
		$args = array(
		'labels' => array(
				'name' => '上课时间',
				'singular_name' => '上课时间',
				'menu_name' => '上课时间',
				'name_admin_bar' => '上课时间',
				'all_items' => '所有上课时间',
				'add_new' => '添加上课时间',
				'add_new_item' => '添加上课时间',
				'edit_item' => '编辑上课时间',
				'new_item' => '添加上课时间',
				'view_item' => '查看上课时间',
				'search_items' => '搜索上课时间',
				'not_found' =>  '未找到上课时间',
				'not_found_in_trash' => '回收站中没有上课时间',
				'parent_item_colon' => 'Parent Page',
				
			),
		'description' => '上课时间',
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'has_archive' => true,
		'menu_position' => true,
		'menu_icon' => null,
		'hierarchical' => FALSE,
		'rewrite' => true,
		'query_var' => true,
		'can_export' => true,
		'supports' => array( 'title','editor' ),
		"taxonomies" => array( "post_tag" )
	);
	register_post_type( 'class_time', $args );
	
	$labels = array(
		"name" => "上课时间分类",
		"label" => "上课时间分类",
		"menu_name" => "上课时间分类",
		"all_items" => "上课时间分类",
		"edit_item" => "编辑上课时间分类",
		"view_item" => "查看上课时间分类",
		"update_item" => "更新上课时间分类",
		"add_new_item" => "添加上课时间分类",
		"new_item_name" => "添加上课时间分类",
		"search_items" => "搜索上课时间分类",
		"popular_items" => "热门上课时间分类",
		);
	register_taxonomy(   
        'class_time_type',   
        array('class_time'),   
        array(   
            'hierarchical' => true,   
            'labels' => $labels,   
            'show_ui' => true,   
            'query_var' => true,   
            'rewrite' => array( 'slug' => 'class_time_type' ),   
        )   
    ); 
  /**
     * 体验名单
     * 
     */
		$args = array(
		'labels' => array(
				'name' => '体验名单',
				'singular_name' => '体验名单',
				'menu_name' => '体验名单',
				'name_admin_bar' => '体验名单',
				'all_items' => '所有体验名单',
				'add_new' => '添加体验名单',
				'add_new_item' => '添加体验名单',
				'edit_item' => '编辑体验名单',
				'new_item' => '添加体验名单',
				'view_item' => '查看体验名单',
				'search_items' => '搜索体验名单',
				'not_found' =>  '未找到体验名单',
				'not_found_in_trash' => '回收站中没有体验名单',
				'parent_item_colon' => 'Parent Page',
				
			),
		'description' => '体验名单',
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'has_archive' => true,
		'menu_position' => true,
		'menu_icon' => null,
		'hierarchical' => FALSE,
		'rewrite' => true,
		'query_var' => true,
		'can_export' => true,
		'supports' => array( 'title'),
		//"taxonomies" => array( "post_tag" )
	);
	register_post_type( 'tiyan', $args );

}


class liebiao {
	function init() {
		$obj_mm_arr = array(
			array(
					'name' =>'课程名',
					'code'=>'courses',
					'up_name'=>'课程图片'
			),
			array(
					'name' =>'学员名',
					'code' => 'students',
					'up_name'=>'学员图片'
			),
				array(
					'name' =>'教练名',
					'code'=>'teachers',
					'up_name'=>'学员图片'
			),
		);
	
		
		foreach ($obj_mm_arr as $key => $value) {
	
				$filter_lie = 'manage_'.$value['code'].'_posts_columns';
				$filter_lie_fun = 'my_'.$value['code'].'_columns';
				$action_lie = 'manage_'.$value['code'].'_posts_custom_column';
				$action_lie_fun = 'output_my_'.$value['code'].'_custom_columns';
				add_filter($filter_lie,array(&$this,'filter_lie_fun'), 1);
				add_action($action_lie,array(&$this,'action_lie_fun'), 0, 2); 
		}
		
	}
	function filter_lie_fun( $tiyan_columns ){
	    	$tiyan_columns['cb'] = '<input type="checkbox" />';//这个是前面那个选框，不要丢了   
	   	   
	        $tiyan_columns['title'] = '课程名';   
			$tiyan_columns['_id_upload']  = '图片';   
			 $tiyan_columns['id'] = __('ID'); 
			
	      	$new_columns['date'] = _x('Date', 'column name');   
	    return $tiyan_columns;
	} 
	function action_lie_fun( $column_name, $post_id ) {
	    switch( $column_name ) {
	 		 case 'id':   
		            echo $post_id;   
		            break; 
		        case '_id_upload' :
		        	$img = get_post_meta( $post_id, '_id_upload', true );
		        	if (!empty($img))
		        	{
		        	echo  '<a target="_blank" href="'.$img.'" ><img name="" src="'.$img.'" width="32" height="32" alt=""></a>';
		        	}
		            break;
	
	    }
	}
	
}
$liebiao = new liebiao();
$liebiao->init();


//体验名单列表

add_filter('manage_tiyan_posts_columns', 'my_tiyan_columns', 1);
add_action('manage_tiyan_posts_custom_column', 'output_my_tiyan_custom_columns', 0, 2); 
  
function my_tiyan_columns( $tiyan_columns ){
    	$tiyan_columns['cb'] = '<input type="checkbox" />';//这个是前面那个选框，不要丢了   
   	    $tiyan_columns['id'] = __('ID');  
        $tiyan_columns['title'] = '家长姓名';   
		$tiyan_columns['_id_dianhua']  = '电话';   
	    $tiyan_columns['_id_email']    = 'Email';   
	    $tiyan_columns['_id_xueyuan']    = '学员姓名';    
	    $tiyan_columns['_id_nianling']    = '学员年龄';     
      	$new_columns['date'] = _x('Date', 'column name');   
    return $tiyan_columns;
} 
function output_my_tiyan_custom_columns( $column_name, $post_id ) {
    switch( $column_name ) {
 		 case 'id':   
            echo $post_id;   
            break; 
        case '_id_dianhua' :
            echo get_post_meta( $post_id, '_id_dianhua', true );
            break;
        case '_id_email' :
            echo get_post_meta( $post_id, '_id_email', true );
            break;
        case '_id_xueyuan' :
            echo get_post_meta( $post_id, '_id_xueyuan', true );
            break;
        case '_id_nianling' :
            echo get_post_meta( $post_id, '_id_nianling', true );
            break;

    }
}


    


/*****


function add_tiyan(){   
    add_menu_page( '体验名单', '体验名单', 'edit_themes', 'ashu_slug','display_add_tiyan','',58);   
}   
  
function display_add_tiyan(){  
   require 'tiyan_list.php'; 
}   
add_action('admin_menu', 'add_tiyan'); 

*///






//add_action( 'add_meta_boxes', 'ashuwp_add_sticky_box' );
/*
function ashuwp_add_sticky_box(){
  add_meta_box( 'ashuwp_product_sticky', '置顶', 'ashuwp_product_sticky', array('page','post','courses','students','teachers'), 'side', 'high' );
}
function ashuwp_product_sticky (){ ?>
  <input id="super-sticky" name="sticky" type="checkbox" value="sticky" <?php checked( is_sticky() ); ?> /><label for="super-sticky" class="selectit">置顶</label>
<?php
}
*/
