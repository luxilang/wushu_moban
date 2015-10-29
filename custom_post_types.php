<?php

add_action( 'init', 'custom_post_types' );
function custom_post_types()
{
	/**
	 * 
	 * 课程
	 * @var unknown_type
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
		'supports' => array( 'title','editor','author','excerpt','thumbnail' ),
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
		'supports' =>array( 'title','editor','author','excerpt','thumbnail' ),
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
		'supports' => array( 'title','editor','author','excerpt','thumbnail' ),
	);
	register_post_type( 'teachers', $args );
	
	
	$labels = array(
		"name" => "教师分类",
		"label" => "教师分类",
		"menu_name" => "教师分类",
		"all_items" => "教师分类",
		"edit_item" => "编辑教师分类",
		"view_item" => "查看教师分类",
		"update_item" => "更新教师分类",
		"add_new_item" => "添加教师分类",
		"new_item_name" => "添加教师分类",
		"search_items" => "搜索教师分类",
		"popular_items" => "热门教师分类",
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
     * 分校信息
     * 
     */
		$args = array(
		'labels' => array(
				'name' => '分校信息',
				'singular_name' => '分校信息',
				'menu_name' => '分校信息',
				'name_admin_bar' => '分校信息',
				'all_items' => '所有分校',
				'add_new' => '添加分校',
				'add_new_item' => '添加分校',
				'edit_item' => '编辑分校',
				'new_item' => '添加分校',
				'view_item' => '查看分校',
				'search_items' => '搜索分校',
				'not_found' =>  '未找到分校',
				'not_found_in_trash' => '回收站中没有分校',
				'parent_item_colon' => 'Parent Page',
			),
		'description' => '分校信息',
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
		'supports' => array( 'title','editor','author','excerpt','thumbnail' ),
	);
	register_post_type( 'school_branch', $args );
	

}



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
