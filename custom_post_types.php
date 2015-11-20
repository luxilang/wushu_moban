<?php
//post类型
class post_type_tp {
	public $post_code;
	public $post_str;
	
	public $post_supports = array( 'title','editor');
	public $has_taxonomy = false;
	public $taxonomy_arr = array();
	public $loop_obj ;
	function init() {
		
		if (!empty($this->loop_obj)  && is_array($this->loop_obj)) {
			
			foreach ($this->loop_obj as $key => $value) {
				$this->post_code = $value['post_code'];
				$this->post_str = $value['post_str'];
				$this->post_supports= $value['post_supports'];
				$this->has_taxonomy= $value['has_taxonomy'];
				$this->taxonomy_code= $value['taxonomy_code'];
				$this->has_taxonomy= $value['has_taxonomy'];
				$this->taxonomy_arr= $value['taxonomy_arr'];
				$this->post();
				if ($this->has_taxonomy) {
					
					if (!empty($this->taxonomy_arr)) {
						foreach ($this->taxonomy_arr as $taxonomy_arr_key => $taxonomy_arr_value) {
								$this->taxonomy($taxonomy_arr_value);
						}
					}
	
					
				}
			}

		}
		else{
		
			$this->post();
			if ($this->has_taxonomy) {
				$this->taxonomy();
			}
		}
	}
	function post() {
		$post_str = $this->post_str;
		$args = array(
		'labels' => array(
				'name' => $post_str,
				'singular_name' => $post_str,
				'menu_name' => $post_str,
				'name_admin_bar' => $post_str,
				'all_items' => '所有'.$post_str,
				'add_new' => '添加'.$post_str,
				'add_new_item' => '添加'.$post_str,
				'edit_item' => '编辑'.$post_str,
				'new_item' => '添加'.$post_str,
				'view_item' => '查看'.$post_str,
				'search_items' => '搜索'.$post_str,
				'not_found' =>  '未找到'.$post_str,
				'not_found_in_trash' => '回收站中没有'.$post_str,
				'parent_item_colon' => 'Parent Page',
			),
		'description' => $post_str,
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
		
		'rewrite' => array( 'slug' =>"{$this->post_code}",'with_front'=>false),
		'query_var' => true,
		'can_export' => true,
		'supports' => $this->post_supports,
		//"taxonomies" => array( "post_tag" )
	);
	register_post_type( $this->post_code, $args );
	}
	function taxonomy($taxonomy_arr_value) {
		
		$post_str = $taxonomy_arr_value['name'];
		$labels = array(
				"name" => "{$post_str}分类",
				"label" => "{$post_str}分类",
				"menu_name" => "{$post_str}分类",
				"all_items" => "{$post_str}分类",
				"edit_item" => "编辑{$post_str}分类",
				"view_item" => "查看{$post_str}分类",
				"update_item" => "更新{$post_str}分类",
				"add_new_item" => "添加{$post_str}分类",
				"new_item_name" => "添加{$post_str}分类",
				"search_items" => "搜索{$post_str}分类",
				"popular_items" => "热门{$post_str}分类",
				);
			register_taxonomy(   
		        $taxonomy_arr_value['code'],   
		        array("{$this->post_code}"),   
		        array(   
		            'hierarchical' => true,   
		            'labels' => $labels,   
		            'show_ui' => true,   
		            'query_var' => true,   
		            'rewrite' => array( 'slug' => $taxonomy_arr_value['code'] ),   
		        )   
		    ); 
	}
}
$post_type_conf = array(
	array(
		'post_code'=>'courses',
		'post_str'=>'课程介绍',
		'post_supports'=>array( 'title' ),
		'has_taxonomy'=>true,
		'taxonomy_arr'=>array(
			array('name'=>'课程介绍','code'=>'courses_type'),
			
		),
		
	),
	array(
		'post_code'=>'students',
		'post_str'=>'学员风采',
		'post_supports'=>array( 'title'),
		'has_taxonomy'=>true,
		'taxonomy_arr'=>array(
			array('name'=>'武术','code'=>'students_type'),
			array('name'=>'风采','code'=>'students_type1')
		),

	),
	array(
		'post_code'=>'teachers',
		'post_str'=>'教练团队',
		'post_supports'=>array( 'title'),
		'has_taxonomy'=>true,
		'taxonomy_arr'=>array(
			array('name'=>'教练','code'=>'teachers_type')
		),
	
	),
	array(
		'post_code'=>'class_env',
		'post_str'=>'上课环境',
		'post_supports'=>array( 'title' ),
		'has_taxonomy'=>true,
		'taxonomy_arr'=>array(
			array('name'=>'上课环境','code'=>'class_env_type')
		),
		
	),
	array(
		'post_code'=>'class_time',
		'post_str'=>'上课时间',
		'post_supports'=>array( 'title'),
		'has_taxonomy'=>true,
				'taxonomy_arr'=>array(
			array('name'=>'上课时间','code'=>'class_time_type')
		),
		
	),
	array(
		'post_code'=>'class_fee',
		'post_str'=>'课程费用',
		'post_supports'=>array( 'title','editor' ),
		'has_taxonomy'=>true,
			'taxonomy_arr'=>array(
				array('name'=>'集体课程','code'=>'class_fee_type'),
				array('name'=>'私教1对1','code'=>'class_fee_type_1v1')
				
		),
		
	),
	array(
		'post_code'=>'class_activities',
		'post_str'=>'优惠活动',
		'post_supports'=>array( 'title','editor' ),
		'has_taxonomy'=>false
	),
	/*
	array(
		'post_code'=>'tiyan',
		'post_str'=>'体验名单',
		'post_supports'=>array( 'title'),
		'has_taxonomy'=>false
	),*/
	/*
	array(
		'post_code'=>'tab_cont',
		'post_str'=>'选项卡',
		'post_supports'=>array( 'title'),
		'has_taxonomy'=>true,
		'taxonomy_code'=>'tab_cont_type'
	),*/
);
$post_type_tp = new post_type_tp();
$post_type_tp->loop_obj = $post_type_conf;
$post_type_tp->init();

class liebiao {
	public $wpdb;
	function init($wpdb) {
		
		$this->wpdb;
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


//$liebiao = new liebiao();
//$liebiao->init($wpdb);
function columns_img($post_id,$flag){
  			$tutu_link = get_post_meta( $post_id, $flag, true );
			$html ='';
			if(!empty($tutu_link)){
				$html = "<a target='_blank' href='".$tutu_link."'><img  src='".$tutu_link."'  width='100'  height='100'/></a>";
			}
			else{
				$html  = '&nbsp;&nbsp;&nbsp;&nbsp;--------';
			}
			return $html ;
}
function columns_leixing($wpdb,$post_id){
			$sql = "
			SELECT wp_term_relationships.*, wp_terms.name FROM  wp_term_relationships,wp_term_taxonomy,wp_terms 
			WHERE  
			wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id 
			AND  wp_terms.term_id = wp_term_taxonomy.term_id 
			AND  object_id = '{$post_id}' 
			";
			$rs = $wpdb->get_results($sql);
			$html = '';
         	if(!empty($rs))
			{
				
					foreach($rs as $v )
					{
						
						$html.=  $v->name."&nbsp,";
					}
				
			}else{
				
			}  
			return trim($html,',');
}
//教练 

add_filter('manage_teachers_posts_columns', 'my_teachers_columns', 1);
add_action('manage_teachers_posts_custom_column', 'output_my_teachers_custom_columns', 0, 2); 
  
function my_teachers_columns( $tiyan_columns ){
    	$tiyan_columns['cb'] = '<input type="checkbox" />';
		$tiyan_columns['_id_upload_teachers']  = '图片'; 
		$tiyan_columns['leixing']  = '类型';         
   	    $tiyan_columns['id'] = __('ID');  
    return $tiyan_columns;
} 
function output_my_teachers_custom_columns( $column_name, $post_id ) {
	global $wpdb;
    switch( $column_name ) {
 		 case 'id':   
            echo $post_id;   
            break; 
        case '_id_upload_teachers' :
			echo  columns_img($post_id,'_id_upload_teachers');
            break;
 		 case 'leixing':   
		 		echo columns_leixing($wpdb,$post_id);
          break; 
    }
}

//课程 
add_filter('manage_courses_posts_columns', 'my_courses_columns', 1);
add_action('manage_courses_posts_custom_column', 'output_my_courses_custom_columns', 0, 2); 
  
function my_courses_columns( $tiyan_columns ){
    	$tiyan_columns['cb'] = '<input type="checkbox" />';//这个是前面那个选框，不要丢了
		$tiyan_columns['_id_upload_home']  = '首页图片/列表封面'; 
		$tiyan_columns['_id_upload_courses']  = '详细页图片'; 
		$tiyan_columns['leixing']  = '类型';         
   	    $tiyan_columns['id'] = __('ID');  
     
      
    return $tiyan_columns;
} 
function output_my_courses_custom_columns( $column_name, $post_id ) {
	global $wpdb;
    switch( $column_name ) {
 		 case 'id':   
            echo $post_id;   
            break; 
        case '_id_upload_home' :
			echo  columns_img($post_id,'_id_upload_home');
            break;
        case '_id_upload_courses' :
			echo  columns_img($post_id,'_id_upload_courses');
            break;
 		 case 'leixing':   
		 		echo columns_leixing($wpdb,$post_id);
          break; 
    }
}



//学员

add_filter('manage_students_posts_columns', 'my_students_columns', 1);
add_action('manage_students_posts_custom_column', 'output_my_students_custom_columns', 0, 2); 
  
function my_students_columns( $tiyan_columns ){
    	$tiyan_columns['cb'] = '<input type="checkbox" />';//这个是前面那个选框，不要丢了
		$tiyan_columns['_id_upload_students']  = '图片'; 
		$tiyan_columns['leixing']  = '类型';         
   	    $tiyan_columns['id'] = __('ID');  
     
      
    return $tiyan_columns;
} 
function output_my_students_custom_columns( $column_name, $post_id ) {
	global $wpdb;
    switch( $column_name ) {
 		 case 'id':   
            echo $post_id;   
            break; 
        case '_id_upload_students' :
			echo  columns_img($post_id,'_id_upload_students');
            break;
 		 case 'leixing':   
		 	echo columns_leixing($wpdb,$post_id);
            break; 
    }
}


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

add_filter('manage_pages_columns', 'add_new_pages_columns');

function add_new_pages_columns($book_columns) {




   $new_columns['cb'] = '<input type="checkbox" />';

   $new_columns['id'] = __('ID');

   $new_columns['title'] = _x( 'Title', 'column name' );

   $new_columns['author'] = __('Author');

   $new_columns['date'] = _x('Date', 'column name');

   return $new_columns;

}






add_action('manage_pages_custom_column', 'manage_pages_columns', 10, 2);

function manage_pages_columns($column_name, $id) {

   global $wpdb;

   switch ($column_name) {

   case 'id':

       echo $id;

       break;

   default:

       break;

   }

}


add_filter('post_type_link', 'custom_teachers_link', 1, 3);

function custom_teachers_link( $link, $post = 0 ){

	if ( $post->post_type == 'teachers' ){

		return site_url( 'teachers/' . $post->ID .'.html' );

	} else {

		return $link;
	}

}

add_filter('post_type_link', 'custom_courses_link', 1, 3);

function custom_courses_link( $link, $post = 0 ){

	if ( $post->post_type == 'courses' ){

		return site_url( 'courses/' . $post->ID .'.html' );

	} else {

		return $link;
	}

}



 /**
  * 
$mytypes = array(//根据需要添加你的自定义文章类型

	'type1' => 'slug1',

	'type2' => 'slug2',

	'type3' => 'slug3'

	);

add_filter('post_type_link', 'my_custom_post_type_link', 1, 3);

function my_custom_post_type_link( $link, $post = 0 ){

	global $mytypes;

	if ( in_array( $post->post_type,array_keys($mytypes) ) ){

		return home_url( $mytypes[$post->post_type].'/' . $post->ID .'.html' );

	} else {

		return $link;

	}

}

add_action( 'init', 'my_custom_post_type_rewrites_init' );

function my_custom_post_type_rewrites_init(){

	global $mytypes;

	foreach( $mytypes as $k => $v ) {

		add_rewrite_rule(

			$v.'/([0-9]+)?.html$',

			'index.php?post_type='.$k.'&p=$matches[1]',

			'top' );

	}

}
  */  


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
