<?php

    
    
    $courses_meta = $courses_info = array();

    $courses_info =  array(
      'title' => '扩展选项',  
      'id'=>'ext_info', 
      'page'=>array('courses'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>'',
    	 'tab'=>true
    );

    $courses_meta[] = array(
	  'name' => '图片上传',
	  'id'   => '_id_upload_courses',
	  'desc' => '请上传图片或者填入图片的URl地址',
	  'std'  => '',
	  'size' => 40,
	  'button_text' => '上传',
	  'type' => 'upload'
	);
	$courses_meta[] = array(
	  'name'  => '课程简介',
	  'id'    => '_id_tinymce_kcjj',
	  'desc'  => '请填写课程介绍',
	  'std'   => '',
	  'media' => 1,
	  'type'  => 'tinymce'
	);
	$courses_meta[] = array(
	  'name'  => '学员保障',
	  'id'    => '_id_tinymce_xybz',
	  'desc'  => '请填写学员保障',
	  'std'   => '',
	  'media' => 1,
	  'type'  => 'tinymce'
	);	
	$courses_meta[] = array(
	  'name'  => '课程评价',
	  'id'    => '_id_tinymce_kcpj',
	  'desc'  => '请填写课程评价',
	  'std'   => '',
	  'media' => 1,
	  'type'  => 'tinymce'
	);
	

	$courses_meta[] = array(
	  'name'  => '扩展阅读',
	  'id'    => '_id_tinymce_kzyd',
	  'desc'  => '请填写扩展阅读',
	  'std'   => '',
	  'media' => 1,
	  'type'  => 'tinymce'
	);
	 $courses_meta[] = array(
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
    $courses_box = new ashu_meta_box($courses_meta, $courses_info);
    
    
    $students_meta = $students_info = array();
   
    $students_info =  array(
      'title' => '扩展选项',  
      'id'=>'ext_info', 
      'page'=>array('students'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>''
    );
    $students_meta[] = array(
	  'name' => '图片上传',
	  'id'   => '_id_upload_students',
	  'desc' => '请上传图片或者填入图片的URl地址',
	  'std'  => '',
	  'size' => 40,
	  'button_text' => '上传',
	  'type' => 'upload'
	);
	
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
	
	
	$students_box = new ashu_meta_box($students_meta, $students_info);
	
	
	$teachers_meta = $teachers_info = array();
	$teachers_info =  array(
      'title' => '扩展选项',  
      'id'=>'ext_info', 
      'page'=>array('teachers'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>'',
	 'tab'=>true
    );
	 $teachers_meta[] = array(
	  'name' => '教练图片上传',
	  'id'   => '_id_upload_teachers',
	  'desc' => '请上传图片或者填入图片的URl地址',
	  'std'  => '',
	  'size' => 40,
	  'button_text' => '上传',
	  'type' => 'upload'
	);
		$teachers_meta[] = array(
	  'name'  => '获奖经历',
	  'id'    => '_id_tinymce_hjjl',
	  'desc'  => '请填写获奖经历',
	  'std'   => '',
	  'media' => 1,
	  'type'  => 'tinymce'
	);
	$teachers_meta[] = array(
	  'name'  => '学员中心',
	  'id'    => '_id_tinymce_xyzx',
	  'desc'  => '请填写学员中心',
	  'std'   => '',
	  'media' => 1,
	  'type'  => 'tinymce'
	);
	$teachers_meta[] = array(
	  'name'  => '教学成果',
	  'id'    => '_id_tinymce_jxcg',
	  'desc'  => '请填写教学成果',
	  'std'   => '',
	  'media' => 1,
	  'type'  => 'tinymce'
	);
	/*
	$teachers_meta[] = array(
	  'name'  => '课堂展示',
	  'id'    => '_id_tinymce_ktzs',
	  'desc'  => '请填写课堂展示',
	  'std'   => '',
	  'media' => 1,
	  'type'  => 'tinymce'
	);*/
	$teachers_meta[] = array(
	  'name'  => '扩展阅读',
	  'id'    => '_id_tinymce_kzyd',
	  'desc'  => '请填写扩展阅读',
	  'std'   => '',
	  'media' => 1,
	  'type'  => 'tinymce'
	);
	$teachers_box = new ashu_meta_box($teachers_meta, $teachers_info);


	
	$tiyan_meta = $tiyan_info = array();

	$tiyan_info =  array(
      'title' => '---',  
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
	
	$class_activities_meta = $class_activities_info = array();

	$class_activities_info =  array(
      'title' => '---',  
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
	  'desc' => '请上传图片或者填入图片的URl地址',
	  'std'  => '',
	  'size' => 40,
	  'button_text' => '上传',
	  'type' => 'upload'
	);
    
	$teachers_box = new ashu_meta_box($class_activities_meta, $class_activities_info);
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
	
