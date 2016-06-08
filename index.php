<?php
get_header();
  	   $home_tab_arr = array('儿童组','少年组','成人组','1对1私教课程');
	   $home_tab_desc_arr = array('授课对象为3岁-10岁少儿','授课对象为10岁-17岁少儿','授课对象为18岁以上成年人','所有课程都设有1对1私教');
    
		function show_nav($home_tab_arr,$home_tab_desc_arr){
		
    
		   $tab_id_2 = 1;
		   $html = '';
		   foreach($home_tab_arr as $home_tab_arr_k=>$home_tab_arr_v)
		   {
			    $active_str_hehe = '';
			    if($home_tab_arr_k == 0)
			    {
				   $active_str_hehe ='class="active"';
			    }
				$html .=  '<li role="presentation" '.$active_str_hehe.' ><i></i><a href="#'.$tab_id_2.'" aria-controls="'.$tab_id_2.'" role="tab" data-toggle="tab">';
				$html .= '<label>'.$home_tab_arr_v.'</label>';
				$html .= '<span>'.$home_tab_desc_arr[$home_tab_arr_k].'</span></a></li>';

			 
				$tab_id_2 ++;
		   }
			return $html;
		}
?>
<div class="container content"> 
  <!--武术课程-->
  <div class="row title">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h1>我们提供的各年龄段武术课程</h1>
      <label>培训项目：少儿武术、散打防身术、太极拳、跆拳道、擒拿格斗、空翻，所有项目（男子女子均可）最低年龄需在3周岁以上</label>
    </div>
  </div>
  <div class="course">
    <div class="row">
      <div class="hidden-lg hidden-md hidden-sm col-xs-12 course-tab">
        <ul class="nav nav-tabs" role="tablist">
			<?php  echo show_nav($home_tab_arr,$home_tab_desc_arr); ?>
        </ul>
      </div>
      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 tab-content"> 
      <?php 
	  	$tab_id = 1;
		   $html = '';
		   foreach($home_tab_arr as $home_tab_arr_k=>$home_tab_arr_v)
		   {
				$active_str_1 = '';
			   if($home_tab_arr_k == 0)
			   {
				   $active_str_1 ='active';
			   }
			   
			   
			?>
      
                    <div class="row tab-pane <?php echo $active_str_1 ?>" role="tabpanel" id="<?php   echo $tab_id ?>">
                    		<?php 
								$sql = "
							SELECT wp_posts.* FROM wp_posts
							LEFT JOIN  
							wp_term_relationships  ON 
							wp_term_relationships.object_id  = wp_posts.ID
							LEFT JOIN
							wp_term_taxonomy
							ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
							LEFT JOIN 
							wp_terms 
							ON  wp_terms.term_id = wp_term_taxonomy.term_id
							WHERE wp_terms.name = '{$home_tab_arr_v}' 
							LIMIT 3
							";
							$rs = $wpdb->get_results($sql);
						
							if (!empty($rs)) {
								foreach ($rs as $key => $rs_o) {
									$img_url = get_post_meta($rs_o->ID,'_id_upload_home',true);
									//$img_url = site_url()."/wp-content/uploads/timthumb.php?src=".site_url().$img_url."&w=280&h=216&q=100&zc=1&ct=1&a=t";
									
									$img_url = my_thumb_img($img_url,"&w=280&h=216".get_timthumb_cf());
									
							?>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                  <div class="box"><a  href="<?php echo get_permalink($rs_o->ID); ?>" ><img src="<?php echo $img_url ?>" width="280" height="216"></a>
                                    <div class="info">
                                      <h3><a href="<?php echo get_permalink($rs_o->ID); ?>" ><?php echo  $rs_o->post_title ?></a></h3>
                                      <label>授课方式：<?php echo  get_post_meta($rs_o->ID,'_skfs_courses',true) ?></label>
                                      <label>优惠活动：<?php echo  get_post_meta($rs_o->ID,'_yhhd_courses',true) ?></label>
                                    </div>
                                  </div>
                          </div>
							<?php 
								}
							}
							
							?>
                    </div>
                
                <?php	
                            $tab_id ++ ;		   
                   }
                ?>
       
        
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs course-tab">
        <ul class="nav nav-tabs" role="tablist">
			<?php  echo show_nav($home_tab_arr,$home_tab_desc_arr); ?>
        </ul>
      </div>
    </div>
  </div>
 <!--选择我们-->
  <?php 
		//echo $content = get_post('9')->post_content;   
    ?>
     <div class="row title">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h1>家长们选择武术世家的理由</h1>
      <label>面向全北京市招收3周岁以上的学员，建议具备以下特点的学员要学习：<br>
        体质弱的学员、想减肥塑身、长期久坐不运动的学员、想掌握一技之长的学员、培养兴趣爱好的学员</label>
    </div>
  </div>
  <div class="row reason">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="blue-box"> <a href="/students.html"><img src="/dist/img/xz1.png"></a>
        <label>我们能帮助孩子</label>
        <p>1.通过我们培训班的学习，强身健体、防御外敌、保护自己和家人的安全</p>
        <p>2.塑身减肥、缓解学习和工作压力、提高身体素质增强抵抗力</p>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="blue-box"> <a href="/teachers.html"><img src="/dist/img/xz2.png"></a>
        <label>我们的教师团队</label>
        <p>我们拥有最专业和最优秀的教练团队，所有的教练员均毕业于首都体育学院，教师的教学经验均在5年以上，这是我们独有和独特之处，我们始终相信只有专一才会专注，只有专注才能专业。</p>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="blue-box"> <a href="/class_env.html"><img src="/dist/img/xz3.png"></a>
        <label>我们的训练场馆</label>
        <p>800平方米(2008奥运会指定训练场馆)安全性高-设施齐全</p>
        <p>1."首都体育学院"校区</p>
        <p>2."海淀体育中心"校区</p>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="blue-box"> <a href="/students.html"><img src="/dist/img/xz4.png"></a>
        <label>我们的教学成果</label>
        <p>97%的家长表示孩子自信了，身体强健了;</p>
        <p>95%的家长愿意推荐武术世家给朋友;</p>
        <p>97%的同学获得过国内外比赛名次;</p>
      </div>
    </div>
  </div>
  <!--我们的团队-->
  <?php 
		//echo $content = get_post('11')->post_content;   
    ?>
    <div class="row title">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h1>我们卓越的教练团队</h1>
      <label>我们拥有最专业和最优秀的教练团队，所有的教练员均毕业于首都体育学院，教师的教学经验均在5年以上，<br>
        这是我们独有和独特之处，我们始终相信只有专一才会专注，只有专注才能专业。 </label>
    </div>
  </div>
  <div class="team">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
          <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
            <div class="info">
              <h2>严厉、完善的选拔和培训体系</h2>
              <ul>
                <li>教练员录用的考核标准：<br>
                  均由首都体育师范学院统一培养并录用；</li>
                <li>录用的教练员等级分为：<br>
                  国家一级教练员、全国冠军教练员、国家健将级教练员，三种级别；</li>
                <li>教练员运动成绩分别为：<br>
                  世界冠军、全国冠军、全国前三名、世界前三名（学员均可核实教练，绝不虚构）</li>
              </ul>
            </div>
          </div>
          <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12"> <!--<a href="/teachers.html"><img src="/dist/img/team.jpg"></a>-->
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="teachers">
              <tr>
              <td>
			  <?php
			  			$args = array();	
                        $args['posts_per_page'] = 3;
						$args['offset'] = 0;
						$args['post_type'] = 'teachers';

						
						$query = new WP_Query( $args );
						if (!empty($query->posts)) {
							$rs = $query->posts;	
							foreach ($rs as $rs_o) {	
										$img_url = get_post_meta($rs_o->ID,'_id_upload_teachers',true);
										
										$img_url = my_thumb_img($img_url,"&w=100&h=100".get_timthumb_cf());

										?>
                                    	
                                     
									<div class="col-lg-4 col-md-4 col-sm-4" style="padding:0px; margin:0px">
									<div class="blue-box" style="padding:5px; margin:0px"> <img src="<?php echo $img_url ?>" alt="<?php echo $rs_o->post_title ?>"  >
									<label><?php echo $rs_o->post_title ?></label>
									<p><?php echo get_post_meta($rs_o->ID,'_teachers_yddj',true)  ?></p>
									<p>少儿武术教学经验:<?php echo get_post_meta($rs_o->ID,'_teachers_sewsjljy',true)  ?></p>
									<p>教学风格:<?php echo get_post_meta($rs_o->ID,'_teachers_jxfg',true)  ?></p>
									
									<a href="<?php echo get_permalink($rs_o->ID) ?>"><i class="glyphicon glyphicon-menu-right"></i>查看详情</a>
									</div>
									</div>
                                    	
                                       
                                    
										<?php
							
							}
							wp_reset_postdata();
						}else{
						?>
<!--                        <td><img src="/dist/img/team1.jpg"></td>
                        <td><img src="/dist/img/team2.jpg"></td>
                        <td><img src="/dist/img/team3.jpg"></td>-->
                        <?php	
							
						}
			  ?>
				</td>
              </tr>
          </table>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!--家长评价-->
  <?php 
		//echo $content = get_post('13')->post_content;   
    ?>
      <div class="row title">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h1>来自家长的声音</h1>
      <label>我们拥有最专业和最优秀的教练团队，所有的教练员均毕业于首都体育学院，教师的教学经验均在5年以上，<br>
        这是我们独有和独特之处，我们始终相信只有专一才会专注，只有专注才能专业。 </label>
    </div>
  </div>
  <div class="row sound">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="blue-box"> <img src="dist/img/jz1.png">
        <label>包佑佳父亲</label>
        <label class="class-from">少儿武术成员家长</label>
        <p>"包佑嘉十分享受武术世家提供给她的舞台。现在的她可以很自信的在更大的舞台上为大家表演武术，展现自我。</p>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="blue-box"> <img src="dist/img/jz2.png">
        <label>曹鑫的父亲</label>
        <label class="class-from">少儿跆拳道成员家长</label>
        <p>"曹馨在武术世家学习跆拳道已经超过3年了。在这里，她十分享受和老师在一起欢乐的学习时光，并希望能够一直在武术世家学习下去。"</p>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="blue-box"> <img src="dist/img/jz3.png">
        <label>魏杏如的母亲</label>
        <label class="class-from">少儿散打成员家长</label>
        <p>"自从上了武术世家的课程，杏如魏杏如变得更加外向和健谈了，现在的她经常会在家里面给我们表演散打。"</p>
      </div>
    </div>
  </div>
</div>
<?php 
	get_footer();

?>
<script src="<?php echo  site_url() ?>dist/js/jQuery-1.11.2.js"></script> 
<script src="<?php echo  site_url() ?>dist/js/bootstrap.min.js"></script> 
<script>
	/*$(function(){
		$('.reason').find('.blue-box').height(400);
	})*/
</script>
</body>
</html>
