<?php

$title_id = $post->ID;
$title_type = $post->title_type;
$host = $post->rs_html_host;
$rs = $post->rs_o;

$is_split_title = $post->is_split_title;


if (isMobile()) {
	$neirong6 = preg_replace ( "/<img.+?src=\'(.+?)\'.+?>/", '<img width="100%" src="' . $host . '\1" />', $post->rs_html_xiangxi );
}else{
	$neirong6 = preg_replace ( "/<img.+?src=\'(.+?)\'.+?>/", '<img src="' . $host . '\1" />', $post->rs_html_xiangxi );
}


$rs_2 = $rs[0];
$sql = "SELECT title_type FROM wp_posts WHERE ID = '{$rs_2->title_id}'";

$rs_3 = $wpdb->get_results($sql);

$seo_type_id = !empty($rs_3[0]->title_type) ? $rs_3[0]->title_type : 0;

$arrr_seoimg = array(
	1=>'wushu.gif',
	2=>'shaoerwushu.gif',
	3=>'chengrensanda.gif',
	4=>'taoquandao.gif',
	5=>'taijiquan.gif',
	6=>'kongfan.gif',

);
$arrr_seoimg_h1 = array(
	1=>'武术课程',
	2=>'少儿武术课程',
	3=>'成人散打课程',
	4=>'跆拳道课程',
	5=>'太极拳课程',
	6=>'空翻课程',

);
if ($is_split_title) {
			 
	?>
    <style>
    
    #inifo99 h1,#inifo99 h2,#inifo99 h3,#inifo99 h4{
		text-align:center;
		
		}
    </style>
	   <div  class="row" style=""   >
			 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"   id="inifo99" style="font-size:14px">
  	    				<?php 
						  	    echo $neirong6 ;
						 ?>
			</div>	 
	  </div>
       <div  class="row" style=""  >
       	<?php
        $up_wenzhang = $wpdb->get_row("select * from wp_posts where  post_status = 'publish'  and  post_type = 'post' and  flag = 1 and  is_split_title = 1  and ID > '{$post->ID}'  order by ID  ASC LIMIT 1  " );
	
        $down_wenzhang = $wpdb->get_row("select * from wp_posts where  post_status = 'publish'  and  post_type = 'post' and  flag = 1 and  is_split_title = 1  and ID < '{$post->ID}'  order by ID  desc LIMIT 1  " );
		
		
		?>
       <table width="100%" border="0" cellspacing="10" cellpadding="20" >
          <tr>
            <td height="59" align="left" style="background-color:#E8E8E8">&nbsp;&nbsp;&nbsp;&nbsp;<?php
            	if(!empty($up_wenzhang->ID))
				{
			?><a href="<?php echo get_permalink($up_wenzhang->ID); ?>"><< &nbsp; 上一篇</a>
            <?php
				}
			?>
            </td>
            <td style="background-color:#E8E8E8">&nbsp;</td>
            <td  style="background-color:#E8E8E8"align="right"><?php
            	if(!empty($down_wenzhang->ID))
				{
			?><a href="<?php echo get_permalink($down_wenzhang->ID); ?>">下一篇 &nbsp; >></a>
            <?php
				}
			?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr>
        </table>

	
       </div>
       <div  class="row" style=""   >
       		<?php  include_once 'changyan_js.php';   ?>
       </div>
       
	<?php 
}else{
	

?>
<div class="row content">
      	<div class="col-lg-12">
        	<div class="row view-info">
        		<?php 
        		if (!empty($arrr_seoimg[$seo_type_id]))
        		{
        			 if (isMobile()) {
        			 	
        			
        			?>
        			
			            <div class="col-lg-4 col-xs-6 col-lg-offset-0 col-xs-offset-3"> <img width="100%" src="/wp-content/uploads/2015/11/student1.jpg"> </div>
			            <div class="col-lg-8 col-xs-12">
			              <h3><?php echo $arrr_seoimg_h1[$seo_type_id] ?></h3>
			              <label><span>授课对象：</span>少儿组3岁~10岁 少年组10岁以上</label>
			              <label><span>课程简述：</span>教师均有5年教学经验,零起点学生以兴趣出发做启蒙;有基础的学生提高综合动作水平,3岁的孩子就可以学。</label>
			              <label><span>授课时间：</span>周一至周五 晚上：6:00-7:30
			周六日 上午9:30-11:00 下午：3:00-4:30 4:30-6:00</label>
			              <label><span>课程费用：</span>集体课程：26元~100元不等; 私教课程：300~400元不等; 上课次数越多，每节课单价越低，祥情请咨询客服！</label>
			              <label><span>开班信息：</span>随到随学</label>
			              <label class="fg">学员至上：免费试课，满意为止（无任何附加费用）</label>
			              <button data-target="#yyModal" data-toggle="modal" class="btn btn-blue btn-lg" type="button"><i class="glyphicon glyphicon-plus"></i>免费试课<span class="bubble">预约</span></button>
			            </div>
			        
        			
        			<?php
							/**
							 * 
							 *<img alt="" src="/dist/seoimg/<?php echo $arrr_seoimg[$seo_type_id] ?>">
        			
        						*/
        			
        			  }else{
        			  	?>
        				<div class="col-lg-4 col-xs-6 col-lg-offset-0 col-xs-offset-3"> <img width="274" height="370" src="/wp-content/uploads/2015/11/student1.jpg"> </div>
			            <div class="col-lg-8 col-xs-12">
			              <h3><?php echo $arrr_seoimg_h1[$seo_type_id] ?></h3>
			              <label><img width="100%" src="/dist/seoimg/weizi.gif"></label>

			              <button data-target="#yyModal" data-toggle="modal" class="btn btn-blue btn-lg" type="button"><i class="glyphicon glyphicon-plus"></i>免费试课<span class="bubble">预约</span></button>
			            </div>
        			  	<?php 
        			  }
        		}else{
        			 	if (isMobile()) {
        					?>
        					 <div class="col-lg-4 col-xs-6 col-lg-offset-0 col-xs-offset-3"> <img width="100%" src="/wp-content/uploads/2015/11/student1.jpg"> </div>
			            <div class="col-lg-8 col-xs-12">
			              <h3>儿童散打课程</h3>
			              <label><span>授课对象：</span>少儿组3岁~10岁 少年组10岁以上</label>
			              <label><span>课程简述：</span>教师均有5年教学经验,零起点学生以兴趣出发做启蒙;有基础的学生提高综合动作水平,3岁的孩子就可以学。</label>
			              <label><span>授课时间：</span>周一至周五 晚上：6:00-7:30
			周六日 上午9:30-11:00 下午：3:00-4:30 4:30-6:00</label>
			              <label><span>课程费用：</span>集体课程：26元~100元不等; 私教课程：300~400元不等; 上课次数越多，每节课单价越低，祥情请咨询客服！</label>
			              <label><span>开班信息：</span>随到随学</label>
			              <label class="fg">学员至上：免费试课，满意为止（无任何附加费用）</label>
			              <button data-target="#yyModal" data-toggle="modal" class="btn btn-blue btn-lg" type="button"><i class="glyphicon glyphicon-plus"></i>免费试课<span class="bubble">预约</span></button>
			            </div>
        					<?php 
        					
        				}else{
        					?>
        						<div class="col-lg-4 col-xs-6 col-lg-offset-0 col-xs-offset-3"> <img width="274" height="370" src="/wp-content/uploads/2015/11/student1.jpg"> </div>
			            <div class="col-lg-8 col-xs-12">
			              <h3>儿童散打课程</h3>
			              <label><img width="100%" src="/dist/seoimg/weizi.gif"></label>

			              <button data-target="#yyModal" data-toggle="modal" class="btn btn-blue btn-lg" type="button"><i class="glyphicon glyphicon-plus"></i>免费试课<span class="bubble">预约</span></button>
			            </div>
        					<?php 
        				}
        		?>
        			
			    	
				<?php 
				/*
				<img alt="" src="/dist/seoimg/wushu.gif">*/ 
        		}
				?>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="view-detail">
              <ul class="nav nav-tabs nav-tabs-view" role="tablist">
              
              <?php 
			    $ashu_courses_tab_arr = get_option('ashu_courses_tab');
				$courses_tab_ini = trim($ashu_courses_tab_arr['_courses_tab_ini']);
				
				if (!empty($courses_tab_ini)) {
				
					$courses_tab_ini_arr = array_filter(explode("\r\n", $courses_tab_ini));
					if (!empty($courses_tab_ini_arr)) {
						foreach ($courses_tab_ini_arr as $key => $value) {
							$tab_id = $key+1;
							if (!empty($value)) {
								list($tab_option_name,$tab_option_id,$tab_option_desc) =  explode("|", $value);
								
								$active_tab = ($key==0)   ?  'class="active"' : ''; 
								?>
                                <li role="presentation" <?php echo  $active_tab ?>><i></i><a href="#<?php echo $tab_id ?>" aria-controls="<?php echo $tab_id ?>" role="tab" data-toggle="tab">
                              <label><?php echo $tab_option_name  ?> </label>
                              </a></li>
                                
                                <?php
								// get_post_meta($post_id,$tab_option_id,true)
							}
						
						}
					}
				
				}
			  ?>
              </ul>
              <div class="tab-content tab-content-view">
              <?php  
			  	if (!empty($courses_tab_ini_arr)) {
						foreach ($courses_tab_ini_arr as $key => $value) {
							$tab_id1 = $key+1;
							if (!empty($value)) {
								list($tab_option_name,$tab_option_id,$tab_option_desc) =  explode("|", $value);
								
								$active_tab1 = ($key==0)   ?  'active' : ''; 
								
			  ?>

                <div class="row tab-pane <?php echo $active_tab1 ?>"  role="tabpanel" id="<?php echo $tab_id1 ?>">
                		<?php 
                		  
                		 if (isMobile()) {
                		  	 $arr_img = array(
	                		  	1=>'tab1.gif',
	                		  	2=>'tab2.gif',
	                		  	3=>'tab3.gif',
	                		  	4=>'tab4.gif',
	                		  	5=>'tab5.gif'
	                		  );
	                		  $seoinmg = '/dist/seoimg/mod/tab'.$tab_id1.'.gif';
                		  }else{
                		 
                		  		$arr_img = array(
                		  	1=>'tab1.gif',
                		  	2=>'tab2.gif',
                		  	3=>'tab3.gif',
                		  	4=>'tab4.gif',
                		  	5=>'tab5.gif'
                		  	);
                		  	$seoinmg = '/dist/seoimg/tab'.$tab_id1.'.gif';
                		  }
                		  
                		   
						  if ($tab_id1 != 6) {
						  	if ($tab_id1 == 1) {
						  		if (isMobile()) {  //自适应文字
						  			?>
						  			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						                  <ul class="nav nav-tabs nav-tabs-level2" role="tablist">
						                    <li role="presentation" class="active"><i></i><a href="#1_1" aria-controls="1_1" role="tab" data-toggle="tab">
						                      <label>试听课程</label>
						                      </a></li>
						                    <li role="presentation"><i></i><a href="#1_2" aria-controls="1_2" role="tab" data-toggle="tab">
						                      <label>正式课程</label>
						                      </a></li>
						                  </ul>
						                  <div class="tab-content"> 
						                    <!--1_1-->
						                    <div class="row tab-pane active"  role="tabpanel" id="1_1">
						                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						                        <h3>课程简述</h3>
						                        <p>教师均有5年教学经验,零起点学生以兴趣出发做启蒙;有基础的学生提高综合动作水平,3岁的孩子就可以学。</p>
						                        <h3>教学特色</h3>
						                        <ul>
						                          <li>我们为了保证课程质量，经过吸取学员和家长之间的意见，最终规定：每个班的人数5~10人；</li>
						                          <li>在学员插班问题上，我们专门为新来的学员分配教练进行指导教学，保证学员的学习效果，帮助插班的学员跟上课程进度；</li>
						                          <li>按照学员的技术水平和接受能力进行分班；</li>
						                          <li>根据学员的情况，为学员量身定制一份教案；</li>
						                          <li>为学员提供免费在线学习课程和相互交流的机会；</li>
						                          <li>所有学员不管是在训练结束后还是在回到家里后，碰到动作上的疑问 或者 关于体育健康的问题均可打电话咨询我们的教练，我们会用我们的实际行动帮助到你。</li>
						                        </ul>
						                      </div>
						                    </div>
						                    <!--1_2-->
						                    <div class="row tab-pane"  role="tabpanel" id="1_2">
						                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						                        <h3>课程简述1</h3>
						                        <p>教师均有5年教学经验,零起点学生以兴趣出发做启蒙;有基础的学生提高综合动作水平,3岁的孩子就可以学。</p>
						                        <h3>教学特色</h3>
						                        <ul>
						                          <li>我们为了保证课程质量，经过吸取学员和家长之间的意见，最终规定：每个班的人数5~10人；</li>
						                          <li>在学员插班问题上，我们专门为新来的学员分配教练进行指导教学，保证学员的学习效果，帮助插班的学员跟上课程进度；</li>
						                          <li>按照学员的技术水平和接受能力进行分班；</li>
						                          <li>根据学员的情况，为学员量身定制一份教案；</li>
						                          <li>为学员提供免费在线学习课程和相互交流的机会；</li>
						                          <li>所有学员不管是在训练结束后还是在回到家里后，碰到动作上的疑问 或者 关于体育健康的问题均可打电话咨询我们的教练，我们会用我们的实际行动帮助到你。</li>
						                        </ul>
						                      </div>
						                    </div>
						                    <!--end--> 
						                  </div>
						                </div>
						  			<?php 
						  		}else{
						  		
						  		?>
						  		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				                  <ul class="nav nav-tabs nav-tabs-level2" role="tablist">
				                    <li role="presentation" class="active"><i></i><a href="#1_1" aria-controls="1_1" role="tab" data-toggle="tab">
				                      <label>试听课程</label>
				                      </a></li>
				                    <li role="presentation"><i></i><a href="#1_2" aria-controls="1_2" role="tab" data-toggle="tab">
				                      <label>正式课程</label>
				                      </a></li>
				                  </ul>
				                  <div class="tab-content"> 
				                    <!--1_1-->
				                    <div class="row tab-pane active"  role="tabpanel" id="1_1">
										<img src="/dist/seoimg/tab_1_0.gif">
				                    </div>
				                    <!--1_2-->
				                    <div class="row tab-pane"  role="tabpanel" id="1_2">
										<img src="/dist/seoimg/tab_1_1.gif">
				                    </div>
				                    <!--end--> 
				                  </div>
				                </div>
						  		<?php 
						  		}
						  		
						  	
						  }elseif ($tab_id1 == 3) {
						  		?>
						  		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                  <!---->
                  <div class="box">
                    <div class="row">
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label><img src="/dist/img/xz1.png">张友佳父亲<span>少儿武术成员家长</span></label>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-right"> <span class="time"> <?php echo date('Y-m-d')?></span> </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 info">
                        <p>周教练耐心 ，细心，幽默风趣，是非常好的教练，教了我们不光武术动作还有相应的文化知识，感谢周教练。</p>
                      </div>
                    </div>
                  </div>
                  <!----> 
                  <!---->
                  <div class="box">
                    <div class="row">
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label><img src="/dist/img/xz1.png">王晓丽母亲<span>少儿武术成员家长</span></label>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-right"> <span class="time"> <?php echo date('Y-m-d',time()-24*3600)?> </span> </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 info">
                        <p>周教练治学严谨，要求严格，能深入了解学生的学习和生活状况，循循善诱，平易近人；注意启发和调动学生的积极性，课堂气氛较为活跃；上课例题丰富，不厌其烦，细心讲解，使学生有所收获；半数认真工整，批改作业认真及时并注意讲解学生易犯错误；最重要的是，能虚心并广泛听取学生的意见和反馈信息，做到及时修正和调整自己的教学。总之是一个不可多得的好教师。</p>
                      </div>
                    </div>
                  </div>
                  <!----> 
                  <!---->
                  <div class="box">
                    <div class="row">
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label><img src="/dist/img/xz1.png">李海洋父亲<span>少儿武术成员家长</span></label>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-right"> <span class="time"><?php echo date('Y-m-d',time()-2*24*3600)?>  </span> </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 info">
                        <p> 对待教学认真负责，语言生动，条理清晰，举例充分恰当，对待学生严格要求，能够鼓励学生踊跃发言，使课堂气      氛比较积极热烈。
                          课堂内容充实，简单明了，使学生能够轻轻松松掌握知识。</p>
                      </div>
                    </div>
                  </div>
                  <!----> 
                </div>
						  		<?php 
						  	
						    }elseif ($tab_id1 == 4) {
						  		?>
						  		 	<?php include_once 'tab_teachers_info.php';  ?>
						  		<?php 
						  	}elseif ($tab_id1 == 5){
						  		?>
						  		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <ul class="nav nav-tabs nav-tabs-level2" role="tablist">
                    <li role="presentation" class="active"><i></i><a href="#5_1" aria-controls="5_1" role="tab" data-toggle="tab">
                      <label>训练花絮</label>
                      </a></li>
                    <li role="presentation"><i></i><a href="#5_2" aria-controls="5_2" role="tab" data-toggle="tab">
                      <label>比赛集锦</label>
                      </a></li>
                    <li role="presentation"><i></i><a href="#5_3" aria-controls="5_3" role="tab" data-toggle="tab">
                      <label>获奖证书</label>
                      </a></li>
                    <li role="presentation"><i></i><a href="#5_4" aria-controls="5_4" role="tab" data-toggle="tab">
                      <label>学员表演</label>
                      </a></li>
                  </ul>
                  <div class="tab-content"> 
                    <!--5_1-->
                    <div class="row tab-pane active"  role="tabpanel" id="5_1">
<a href="/dist/img/student.jpg" class="example-image-link" data-lightbox="example-set" data-title="">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                        <div class="picList">
                          <div class="b-layer" data-toggle="modal" data-target="#Modal"><i class="glyphicon glyphicon-plus"></i></div>
                          <img src="/dist/img/student.jpg"> </div>

                      </div>
</a>
<a href="/dist/img/student2.jpg" class="example-image-link" data-lightbox="example-set" data-title="">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="picList">
                          <div class="b-layer" data-toggle="modal" data-target="#Modal"><i class="glyphicon glyphicon-plus"></i></div>
                          <img src="/dist/img/student2.jpg"> </div>
                      </div>
</a>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="picList">
                          <div class="b-layer" data-toggle="modal" data-target="#Modal"><i class="glyphicon glyphicon-plus"></i></div>
                          <img src="/dist/img/student1.jpg"> </div>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                            <button type="button" class="btn btn-lg btn-block btn-blue">加载更多 <i class="glyphicon glyphicon-save"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--5_2-->
                    <div class="row tab-pane"  role="tabpanel" id="5_2">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="picList">
                          <div class="b-layer"><i class="glyphicon glyphicon-plus"></i></div>
                          <img src="/dist/img/student1.jpg"> </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="picList">
                          <div class="b-layer"><i class="glyphicon glyphicon-plus"></i></div>
                          <img src="/dist/img/student.jpg"> </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="picList">
                          <div class="b-layer"><i class="glyphicon glyphicon-plus"></i></div>
                          <img src="/dist/img/student3.jpg"> </div>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                            <button type="button" class="btn btn-lg btn-block btn-blue">加载更多 <i class="glyphicon glyphicon-save"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--5_3-->
                    <div class="row tab-pane"  role="tabpanel" id="5_3">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="picList">
                          <div class="b-layer"><i class="glyphicon glyphicon-plus"></i></div>
                          <img src="/dist/img/student2.jpg"> </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="picList">
                          <div class="b-layer"><i class="glyphicon glyphicon-plus"></i></div>
                          <img src="/dist/img/student1.jpg"> </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="picList">
                          <div class="b-layer"><i class="glyphicon glyphicon-plus"></i></div>
                          <img src="/dist/img/student.jpg"> </div>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                            <button type="button" class="btn btn-lg btn-block btn-blue">加载更多 <i class="glyphicon glyphicon-save"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--5_4-->
                    <div class="row tab-pane"  role="tabpanel" id="5_4">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="picList">
                          <div class="b-layer"><i class="glyphicon glyphicon-plus"></i></div>
                          <img src="/dist/img/student1.jpg"> </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="picList">
                          <div class="b-layer"><i class="glyphicon glyphicon-plus"></i></div>
                          <img src="/dist/img/student.jpg"> </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="picList">
                          <div class="b-layer"><i class="glyphicon glyphicon-plus"></i></div>
                          <img src="/dist/img/student3.jpg"> </div>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                            <button type="button" class="btn btn-lg btn-block btn-blue">加载更多 <i class="glyphicon glyphicon-save"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--end--> 
                  </div>
                </div>
						  		<?php 
						  	}else{
						  		
						  	
						  	if (isMobile()) {
						  		
						  		?>
						  		<img alt=""  width="100%" src="<?php echo $seoinmg ?>">
						  		<?php 
						  	}else{
						  		?>
						  		<img alt="" src="<?php echo $seoinmg ?>">
						  		<?php 
						  		
						  	}
						  	}
                		?>
                		
                		<?php 
						  }else{
						  	    echo $neirong6 ;
						  	    ?>
						  	    <?php include_once 'changyan_js.php';  ?>
						  	    <?php 
						  	    
						  	    
						  }
                		?>

                		
                </div>
               <?php 
							}
						}
				}
			   ?>
              </div>
           </div>
        </div>
      </div>
<?php include_once 'modal.php';  ?>
<?php 
}
?>