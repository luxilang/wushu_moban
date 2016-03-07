<?php

$title_id = $post->ID;
$title_type = $post->title_type;
$host = $post->rs_html_host;
$rs = $post->rs_o;


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

)

?>
<div class="row content">
      	<div class="col-lg-12">
        	<div class="row view-info">
        		<?php 
        		if (!empty($arrr_seoimg[$seo_type_id]))
        		{
        			?>
        			<img alt="" src="/dist/seoimg/<?php echo $arrr_seoimg[$seo_type_id] ?>">
        			<?php 
        			
        		}else{
        		?>
				<img alt="" src="/dist/seoimg/wushu.gif">
				<?php 
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
						  	if ($tab_id1 == 3) {
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
						  		 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				                    <div class="blue-box"> <img src="/dist/img/xz1.png">
				                      <label>周教练</label>
				                      <span class="class-from">国家一级运动员</span>
				                      <p>少儿武术教学经验：6年以上教学风格：幽默风趣，善于引导孩子在兴趣中学习；</p>
				                      <a href="/teachers/100.html"><i class="glyphicon glyphicon-menu-right"></i>查看详情</a>
				                    </div>
				                  </div>
				                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				                    <div class="blue-box"> <img src="/dist/img/xz2.png">
				                      <label>周教练</label>
				                      <span class="class-from">国家一级运动员</span>
				                      <p>少儿武术教学经验：6年以上教学风格：幽默风趣，善于引导孩子在兴趣中学习；</p>
				                      <a href="#"><i class="glyphicon glyphicon-menu-right"></i>查看详情</a>
				                    </div>
				                  </div>
				                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				                    <div class="blue-box"> <img src="/dist/img/xz3.png">
				                      <label>周教练</label>
				                      <span class="class-from">国家一级运动员</span>
				                      <p>少儿武术教学经验：6年以上教学风格：幽默风趣，善于引导孩子在兴趣中学习；</p>
				                      <a href="#"><i class="glyphicon glyphicon-menu-right"></i>查看详情</a>
				                    </div>
				                  </div>
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
						  	    <div id="SOHUCS"></div>
								<script charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/changyan.js" ></script>
								<script type="text/javascript">
								    window.changyan.api.config({
								        appid: 'cys3XmfBU',
								        conf: 'prod_674cebb9c09386b41dfc0b70d2a82563'
								    });
								</script> 
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
