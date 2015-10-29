<?php



    $up_meta = array();

    
    $upload_info =  array(
      'title' => '图片信息',  
      'id'=>'upload_info_id', 
      'page'=>array('courses','students','teachers'), 
      'context'=>'normal', 
      'priority'=>'low',
      'callback'=>''
    );
    $up_meta[] = array(
	  'name' => '图片上传',
	  'id'   => '_id_upload',
	  'desc' => '请上传图片或者填入图片的URl地址',
	  'std'  => '',
	  'size' => 40,
	  'button_text' => '上传',
	  'type' => 'upload'
	);
	/*
	$up_meta[] = array(
	  'name'    => '是否显示封面',
	  'id'      => '_is_top',
	  'desc'    => '是否显示封面？',
	  'std'     => '1',
	  'buttons' => array(
	    '1'      => '显示',
	    '0'    => '不显示',
	  ),
	  'type'    => 'radio'
	);
	*/
    $up_box = new ashu_meta_box($up_meta, $upload_info);
    
   
    
    
    /**
     * 有关课程的  
     * 
     * 课程简介    课程评价   教练简介  学员成功  扩展阅读
     */









