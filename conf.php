<?php

	$email_tel_conf = array(
	  'full_name' => '邮箱手机配置',
	  'optionname'=>'email_tel', //设置名称，获取设置选项用 
	  'child'=>false,
	  'filename' => 'email_tel_page' //设置页面的url 
	);
	$email_tel_option = array();
	$email_tel_option[] = array('desc' => '', 'type' => 'open');
	$email_tel_option[] = array(
	  'name' => '邮箱',
	  'id'   => '_auto_email',
	  'desc' => '免费体验提交后自动发邮件的接收邮箱，多个邮箱用";"分割',
	  'std'  => '',
	  'size' => 100,
	  'type' => 'text'
	);
	$email_tel_option[] = array(
	  'name' => '手机',
	  'id'   => '_auto_tel',
	  'desc' => '免费体验提交后自动发短信的接收短信的手机，多个手机用";"分割',
	  'std'  => '',
	  'size' => 100,
	  'type' => 'text'
	);
	
	$email_tel_option[] = array('desc' => '', 'type' => 'close');
	$email_tel_p = new ashu_option_class($email_tel_option, $email_tel_conf);
	
	
	
	
	
	
	$courses_tab_conf = array(
	  'full_name' => '课程页面选项卡',
	  'optionname'=>'courses_tab', //设置名称，获取设置选项用 
	  'child'=>false,
	  'filename' => 'courses_tab_page' //设置页面的url 
	);
	
	$courses_tab_option = array();

	$courses_tab_option[] = array('desc' => '', 'type' => 'open');
	
	$courses_tab_option[] = array(
	  'name' => '课程页面选项卡参数',
	  'id'   => '_courses_tab_ini',
	  'desc' => "课程页面选项卡参数<br />(回车是后可填写多个选项卡每条选项卡以'|'分割)<br />
	  选项卡名称 |选项卡数据入库ID(必须英文)|选项卡描述

	  ",
	  'std'  => '',
	  'size' => array(60,12),
	  'type' => 'textarea'
	);
		
	$courses_tab_option[] = array('desc' => '', 'type' => 'close');
	$teachers_tab_conf = array(
	  'full_name' => '教练页面选项卡',
	  'optionname'=>'teachers_tab',
	  'child'=>false,
	  'filename' => 'teachers_tab_page'
	);
	
	$teachers_tab_option[] = array('desc' => '', 'type' => 'open');
	
	$teachers_tab_option[] = array(
	  'name' => '教练页面选项卡参数',
	  'id'   => '_teachers_tab_ini',
	  'desc' => '教练页面选项卡参数',
	  'std'  => '',
	  'size' => array(60,12),
	  'type' => 'textarea'
	);
		
	$teachers_tab_option[] = array('desc' => '', 'type' => 'close');
	
	
	
	$courses_tab_page = new ashu_option_class($courses_tab_option, $courses_tab_conf);
	$teachers_tab_page = new ashu_option_class($teachers_tab_option, $teachers_tab_conf);
	//设置tb 值
	function set_tab_ini($courses_tab_ini) {
		$courses_tab_ini_good_arr = array();
		if (!empty($courses_tab_ini)) {
		
		$courses_tab_ini_arr = array_filter(explode("\r\n", $courses_tab_ini));
			if (!empty($courses_tab_ini_arr)) {
				foreach ($courses_tab_ini_arr as $key => $value) {
					if (!empty($value)) {
						list($tab_option_name,$tab_option_id,$tab_option_desc) =  explode("|", $value);
						
						if ('_id_tinymce_kcpj' == $tab_option_id) {
							$courses_tab_ini_good_arr[] =  array(
							  'name'  => $tab_option_name,
							  'id'    =>$tab_option_id,
							  'desc'  =>$tab_option_desc,
							  'std'   => '',
							  'media' => 1,
							  'type'  => 'courses_evaluation'
							);
						}elseif( '_id_tinymce_xyxs' == $tab_option_id ){
							$courses_tab_ini_good_arr[] =  array(
							  'name'  => $tab_option_name,
							  'id'    =>$tab_option_id,
							  'desc'  =>$tab_option_desc,
							  'std'   => '',
							  'media' => 1,
							  'type'  => 'students_aspirations'
							);
						}elseif( '_id_tinymce_xycg' == $tab_option_id  ||  '_id_tinymce_jxcg' == $tab_option_id  ||  '_id_tinymce_ktzs' == $tab_option_id  ){ 
							//课堂展示 //教学成果       //学员成果
							$courses_tab_ini_good_arr[] =  array(
							  'name'  => $tab_option_name,
							  'id'    =>$tab_option_id,
							  'desc'  =>$tab_option_desc,
							  'std'   => '',
							  'media' => 1,
							  'type'  => 'img_up'
							);
						}else{
							$courses_tab_ini_good_arr[] =  array(
							  'name'  => $tab_option_name,
							  'id'    =>$tab_option_id,
							  'desc'  =>$tab_option_desc,
							  'std'   => '',
							  'media' => 1,
							  'type'  => 'tinymce'
							);
						}
					}
				
				}
			}
		
		}
		return $courses_tab_ini_good_arr;
	}
	$ashu_courses_tab_arr = get_option('ashu_courses_tab');
	$courses_tab_ini = trim($ashu_courses_tab_arr['_courses_tab_ini']);
	$courses_tab_ini_arr = set_tab_ini($courses_tab_ini);
	
	$ashu_teachers_tab_arr = get_option('ashu_teachers_tab');
	$teachers_tab_ini = trim($ashu_teachers_tab_arr['_teachers_tab_ini']);
	$teachers_tab_ini_arr = set_tab_ini($teachers_tab_ini);
	
	//print_R($courses_tab_ini_arr);
	

 
    
    $courses_meta = $courses_info = $courses_info_ziduan =$courses_meta_ziduan = array();
	$courses_meta_img = $courses_info_img = array();
    $courses_info_img =  array(
      'title' => '图片部分',  
      'id'=>'ext_info_img', 
      'page'=>array('courses'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>'',
      'tab'=>true
    );
     $courses_meta_img[] = array(
	  'name' => '首页图片上传',
	  'id'   => '_id_upload_home',
	  'desc' => '图片大小(280*216)',
	  'std'  => '',
	  'size' => 40,
	  'button_text' => '上传',
	  'type' => 'upload'
	);
	$courses_meta_img[] = array(
	  'name' => '详细图片上传',
	  'id'   => '_id_upload_courses',
	  'desc' => '图片大小(274*370)',
	  'std'  => '',
	  'size' => 40,
	  'button_text' => '上传',
	  'type' => 'upload'
	);
	$courses_meta_img[] = array(
	  'name'    => '是否显示封面',
	  'id'      => '_is_top',
	  'desc'    => '是否显示封面？',
	  'std'     => '0',
	  'buttons' => array(
	    '1'      => '显示',
	    '0'    => '不显示',
	  ),
	  'type'    => 'radio'
	  
	);
    $courses_box_img = new ashu_meta_box($courses_meta_img, $courses_info_img);
    $courses_info_ziduan =  array(
      'title' => '课程详细字段',  
      'id'=>'ext_info1', 
      'page'=>array('courses'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>'',
    	'tab'=>true
    );
     $courses_meta_ziduan[] = array(
	  'name' => '授课方式',
	  'id'   => '_skfs_courses',
	  'desc' => '授课方式',
	    'std'  => '',
	  'size' => array(60,5),
	  'type' => 'textarea'
	);
	$courses_meta_ziduan[] = array(
	  'name' => '优惠活动',
	  'id'   => '_yhhd_courses',
	  'desc' => '优惠活动',
	    'std'  => '',
	  'size' => array(60,5),
	  'type' => 'textarea'
	);	
     $courses_meta_ziduan[] = array(
	  'name' => '授课对象',
	  'id'   => '_skdx_courses',
	  'desc' => '授课对象',
	    'std'  => '',
	  'size' => array(60,5),
	  'type' => 'textarea'
	);
	  $courses_meta_ziduan[] = array(
	  'name' => '授课时间',
	  'id'   => '_sksj_courses',
	  'desc' => '授课时间',
	   'std'  => '',
	  'size' => array(60,5),
	  'type' => 'textarea'
	);
	  $courses_meta_ziduan[] = array(
	  'name' => '授课费用',
	  'id'   => '_skfy_courses',
	  'desc' => '授课费用',
	    'std'  => '',
	  'size' => array(60,5),
	  'type' => 'textarea'
	);
     $courses_meta_ziduan[] = array(
	  'name' => '学员至上',
	  'id'   => '_syzs_courses',
	  'desc' => '学员至上',
	   'std'  => '',
	  'size' => array(60,5),
	  'type' => 'textarea'
	);
	$courses_meta_ziduan[] = array(
	  'name' => '开班信息',
	  'id'   => '_kbxi_courses',
	  'desc' => '开班信息',
	    'std'  => '',
	  'size' => array(60,5),
	  'type' => 'textarea'
	);
	$courses_meta_ziduan[] = array(
	  'name' => '课程简述',
	  'id'   => '_duandesc_courses',
	  'desc' => '课程简述',
	  'std'  => '',
	  'size' => array(60,5),
	  'type' => 'textarea'
	);

	
    $courses_box_ziduan = new ashu_meta_box($courses_meta_ziduan, $courses_info_ziduan);
    
    $courses_info =  array(
      'title' => '课程选项卡',  
      'id'=>'ext_info', 
      'page'=>array('courses'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>'',
      'tab'=>true
    );
	$courses_meta = array_merge($courses_meta,$courses_tab_ini_arr);

    $courses_box = new ashu_meta_box($courses_meta, $courses_info);
    
    
    $students_meta = $students_info = array();
   
    $students_info =  array(
      'title' => '&nbsp',  
      'id'=>'ext_info', 
      'page'=>array('students'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>''
    );
    $students_meta[] = array(
	  'name' => '封面缩略图片上传',
	  'id'   => '_id_upload_students',
	  'desc' => '图片大小274*370',
	  'std'  => '',
	  'size' => 40,
	  'button_text' => '上传',
	  'type' => 'upload'
	);
    $students_meta[] = array(
	  'name' => '图片上传',
	  'id'   => '_id_upload_students_real',
	  'desc' => '图片上传',
	  'std'  => '',
	  'size' => 40,
	  'button_text' => '上传',
	  'type' => 'upload'
	);
	/*
	$students_meta[] = array(
	  'name'    => '图片类别',
	  'id'      => '_id_imgs_type',
	  'desc'    => '请选择图片类别',
	  'std'     => array(),
	  'buttons' => array(
	    'xlhx'  => '训练花絮',
	    'bsjj' => '比赛锦集',
	    'hjzs' => '获奖证书',
	    'xyby'  => '学员表演'
	  ),
	  'type'    => 'checkbox'
	);
	*/
	
	$students_box = new ashu_meta_box($students_meta, $students_info);
	
	//教练
	$teachers_meta = $teachers_info = array();
	$teachers_meta_detail = $teachers_info_detail = array();
	
	$teachers_info_detail =  array(
      'title' => '教练详细信息',  
      'id'=>'ext_info_detail', 
      'page'=>array('teachers'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>'',
	  'tab'=>true
    );
	$teachers_meta_detail[] = array(
	  'name' => '教练图片上传',
	  'id'   => '_id_upload_teachers',
	  'desc' => '图片大小 212 *212',
	  'std'  => '',
	  'size' => 40,
	  'button_text' => '上传',
	  'type' => 'upload'
	);
	 $teachers_meta_detail[] = array(
	  'name' => '教练姓名',
	  'id'   => '_teachers_name',
	  'desc' => '教练姓名',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);
	 $teachers_meta_detail[] = array(
	  'name' => '习武年限',
	  'id'   => '_teachers_xwnx',
	  'desc' => '习武年限例子：18年',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);
	 $teachers_meta_detail[] = array(
	  'name' => '武术段位',
	  'id'   => '_teachers_wsdw',
	  'desc' => '武术段位例子：五段',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);
	 $teachers_meta_detail[] = array(
	  'name' => '运动等级',
	  'id'   => '_teachers_yddj',
	  'desc' => '运动等级例子：国家一级运动员',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);
	 $teachers_meta_detail[] = array(
	  'name' => '武术最高级别',
	  'id'   => '_teachers_wszgjb',
	  'desc' => '武术最高级别例子：武英级(健将运动员)',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);
	
	 $teachers_meta_detail[] = array(
	  'name' => '少儿武术教学经验',
	  'id'   => '_teachers_sewsjljy',
	  'desc' => '少儿武术教学经验例子：6年以上',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);
	 $teachers_meta_detail[] = array(
	  'name' => '毕业于',
	  'id'   => '_teachers_by',
	  'desc' => '毕业于例子：首都体育学院-武术系',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);

	$teachers_meta_detail[] = array(
	  'name' => '教学风格',
	  'id'   => '_teachers_jxfg',
	  'desc' => '教学风格例子：幽默风趣，善于引导孩子在兴趣中学习',
	  'std'  => '',
	  'size' => array(60,5),
	  'type' => 'textarea'
	);
	
	$teachers_box_detail = new ashu_meta_box($teachers_meta_detail, $teachers_info_detail);

	
	$teachers_info =  array(
      'title' => '选项卡',  
      'id'=>'ext_info', 
      'page'=>array('teachers'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>'',
	 'tab'=>true
    );


	$teachers_meta = array_merge($teachers_meta,$teachers_tab_ini_arr);
	$teachers_box = new ashu_meta_box($teachers_meta, $teachers_info);


	//预约 体验
	$tiyan_meta = $tiyan_info = array();

	$tiyan_info =  array(
      'title' => '&nbsp',  
      'id'=>'ext_info', 
      'page'=>array('tiyan'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>'',
	 'tab'=>true
    );
    
    $tiyan_meta[] = array(
	  'name' => '电话',
	  'id'   => '_id_dianhua',
	  'desc' => '电话',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);
    
    $tiyan_meta[] = array(
	  'name' => 'Email',
	  'id'   => '_id_email',
	  'desc' => 'Email',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);
	    $tiyan_meta[] = array(
	  'name' => '学员姓名',
	  'id'   => '_id_xueyuan',
	  'desc' => '学员姓名',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);
	    $tiyan_meta[] = array(
	  'name' => '学员年龄',
	  'id'   => '_id_nianling',
	  'desc' => '年龄',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);

	$teachers_box = new ashu_meta_box($tiyan_meta, $tiyan_info);
	//活动
	$class_activities_meta = $class_activities_info = array();

	$class_activities_info =  array(
      'title' => '&nbsp',  
      'id'=>'ext_info', 
      'page'=>array('class_activities'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>'',
	 'tab'=>true
    );
    
	 $class_activities_meta[] = array(
	  'name' => '活动缩略图上传',
	  'id'   => '_id_upload_activities',
	  'desc' => '图片大小259*202',
	  'std'  => '',
	  'size' => 40,
	  'button_text' => '上传',
	  'type' => 'upload'
	);
    
	$teachers_box = new ashu_meta_box($class_activities_meta, $class_activities_info);
	//环境
	$class_env_meta = $class_env_info = array();

	$class_env_info =  array(
      'title' => '&nbsp',  
      'id'=>'ext_info', 
      'page'=>array('class_env'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>'',
	  'tab'=>true
    );
    
	 $class_env_meta[] = array(
	  'name' => '环境图上传',
	  'id'   => '_id_upload_env',
	  'desc' => '图片大小274*220',
	  'std'  => '',
	  'size' => 40,
	  'button_text' => '上传',
	  'type' => 'upload'
	);
    
	$teachers_box = new ashu_meta_box($class_env_meta, $class_env_info);
	//时间
	$class_time_meta = $class_time_info = array();
	$class_time_info =  array(
      'title' => '上课时间选项',  
      'id'=>'ext_info', 
      'page'=>array('class_time'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>'',
	  //'tab'=>true
    );
    
    
    //时间段短选项
    $ashu_time_duan_arr = get_option('ashu_time_duan');
     
    if (!empty($ashu_time_duan_arr)) {
    	$ashu_time_duan_arr_new = array();
    	foreach ($ashu_time_duan_arr as $k=>$time_duan_item) {
    	
    			$time_duan_item_arr  = array_filter(explode("|", $time_duan_item));
    			$time_duan_item_arr_new =array();
    			foreach ($time_duan_item_arr as $kk=>$vv) {
    				$kk ++;
    				$time_duan_item_arr_new['shijian'.$kk] = trim($vv);
    			}
    			$ashu_time_duan_arr_new[$k]  = $time_duan_item_arr_new;
    	}
    }
    
    
    
	$arr_heng_v = array('周一','周二','周三','周四','周五','周六','周日');
	$arr_heng_k = array('zhou1','zhou2','zhou3','zhou4','zhou5','zhou6','zhou7');
	//$arr_shu_v = array('上午9:30-11:00','下午3:00-4:30','下午4:30-6:00','晚上6:00-7:30');
	//$arr_shu_k = array('shijian1','shijian2','shijian3','shijian4');
	
	//$buttons_arr = array_combine($arr_shu_k,$arr_shu_v);
	$k_1 = 1;
	foreach($arr_heng_v as $k=>$v)
	{
		
		$class_time_meta[] = array(
		  'name'    => $v,
		  'id'      => $arr_heng_k[$k],
		  'desc'    => '',
		  'std'     => '',
		  'buttons' => !empty($ashu_time_duan_arr_new['_time_duan_zhou'.$k_1]) ? $ashu_time_duan_arr_new['_time_duan_zhou'.$k_1] : '',
		  'type'    => 'checkbox'
		);
		$k_1 ++ ;
	}
	$class_time_box = new ashu_meta_box($class_time_meta, $class_time_info);

	//上课时间   的 时间管理
	$time_duan_conf = array(
	  'full_name' => '时间段管理',
	  'optionname'=>'time_duan', //设置名称，获取设置选项用 
	  'child'=>false,
	  'filename' => 'time_duan_page' //设置页面的url 
	);
	$time_duan_option = array();
	$time_duan_option[] = array('desc' => '', 'type' => 'open');
	$kkk = 1;
	foreach ($arr_heng_v as $key => $value) {
			$time_duan_option[] = array(
			  'name' => $value,
			  'id'   => '_time_duan_zhou'.$kkk,
			  'desc' => $value.'时间段"|"隔开',
			  'std'  => '',
			  'size' => 100,
			  'type' => 'text'
			);
			$kkk ++;
	}


	
	$time_duan_option[] = array('desc' => '', 'type' => 'close');
	$time_duan_p = new ashu_option_class($time_duan_option, $time_duan_conf);
	
	
	//费用

	
	
	
	/***
	$tab_cont_info =  $tab_cont_meta = array();
	
	$tab_cont_info =  array(
      'title' => '&nbsp',  
      'id'=>'ext_info', 
      'page'=>array('tab_cont'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>''
    );
	
	$tab_cont_meta[] = array(
	  'name' => '选线卡唯一标识（必须英文）',
	  'id'   => '_id_tab_en',
	  'desc' => '必须英文',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);
	
	
	$tab_cont_box = new ashu_meta_box($tab_cont_meta, $tab_cont_info)
*/
	
//排序字段
/**
<?php 
 $catid = $options['topiccatid'];
 $args=array(
 'child_of'=>$catid,
 'orderby' => 'term_group',
 'order'=>'ASC',
 'hide_empty' => 0, 
 );
 $categories=get_categories($args);
 ?>
 */

function mbt_add_category_field(){ 
	 echo '<div class="form-field"> 
	 <label for="cat-num">排序序号</label> 
	 <input name="_term_order" id="cat-num" type="text" value="" size="40"> 
	 <p>数字越大，越靠前</p> 
	 </div>'; 
} 
add_action('courses_type_add_form_fields','mbt_add_category_field',10,2); 
 
// 分类编辑字段 
function mbt_edit_category_field($tag){ 
 echo '<tr class="form-field"> 
 <th scope="row"><label for="cat-num">排序</label></th> 
 <td> 
 <input name="_term_order" id="cat-num" type="text" value="'; 
 echo ( ! empty( $tag->displayorder ) ) ? $tag->displayorder : '0';
 echo '" size="40"/><br> 
  
 </td> 
 </tr>'; 
} 
add_action('courses_type_edit_form_fields','mbt_edit_category_field',10,2); 
 
// 保存数据 
function mbt_taxonomy_metadate($term_id){ 
 global $wpdb;
 if( isset( $_POST['_term_order'] ) ) {$wpdb->update( $wpdb->terms,array('displayorder' => $_POST['_term_order']),array( 'term_id'=> $term_id));} 
} 
 
// 虽然要两个钩子，但是我们可以两个钩子使用同一个函数 
add_action('created_courses_type','mbt_taxonomy_metadate',10,1); 
add_action('edited_courses_type','mbt_taxonomy_metadate',10,1);




	//分校
	$school_info_meta = $school_info_info = array();
	$school_map_meta = $school_map_info = array();
	$school_info_info =  array(
      'title' => '&nbsp',  
      'id'=>'ext_info', 
      'page'=>array('school_info'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>'',
		//'tab'=>true
    );
    
    $school_info_meta[] = array(
	  'name' => '学院地址',
	  'id'   => '_school_ad',
	  'desc' => '',
	  'std'  => '',
	  'size' => 80,
	  'type' => 'text'
	);
	 $school_info_meta[] = array(
	  'name' => '联系电话',
	  'id'   => '_school_phone',
	  'desc' => '',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);
	 $school_info_meta[] = array(
	  'name' => '乘车路线',
	  'id'   => '_school_bus_line',
	  'desc' => '',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);
	 $school_info_meta[] = array(
	  'name' => '地铁路线',
	  'id'   => '_school_tiebus_line',
	  'desc' => '',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);
	
    $school_info_box = new ashu_meta_box($school_info_meta, $school_info_info);

	$school_map_info =  array(
      'title' => '地图信息',  
      'id'=>'ext_info_map', 
      'page'=>array('school_info'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>'',
		//'tab'=>true
    );
    $school_map_meta[] = array(
	  'name' => '学院标题',
	  'id'   => '_school_map_title',
	  'desc' => '地图显示的标题信息',
	  'std'  => '',
	  'size' => 40,
	  'type' => 'text'
	);

	$school_map_meta[] = array(
	  'name' => '坐标经度x',
	  'id'   => '_school_map_point_x',
	  'desc' => '<a target="_blank" href="http://api.map.baidu.com/lbsapi/creatmap/">获取地图坐标</a>,打开链接定位地址，复制x坐标',
	  'std'  => '',
	  'size' => 30,
	  'type' => 'text'
	);
	$school_map_meta[] = array(
	  'name' => '坐标纬度y',
	  'id'   => '_school_map_point_y',
	  'desc' => '<a target="_blank" href="http://api.map.baidu.com/lbsapi/creatmap/">获取地图坐标</a>,打开链接定位地址，复制x坐标',
	  'std'  => '',
	  'size' => 30,
	  'type' => 'text'
	);
    $school_map_box = new ashu_meta_box($school_map_meta, $school_map_info);
    
