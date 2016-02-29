<?php

$title_id = $post->ID;
$title_type = $post->title_type;
$host = $post->rs_html_host;
$rs = $post->rs_o;
$neirong6 = preg_replace ( "/<img.+?src=\'(.+?)\'.+?>/", '<img src="' . $host . '\1" />', $post->rs_html_xiangxi );

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
                		  $arr_img = array(
                		  	1=>'tab1.gif',
                		  	2=>'tab2.gif',
                		  	3=>'tab3.gif',
                		  	4=>'tab4.gif',
                		  	5=>'tab5.gif'
                		  	
                		  );
                		   $seoinmg = '/dist/seoimg/tab'.$tab_id1.'.gif';
						  if ($tab_id1 != 6) {
                		?>
                		<img alt="" src="<?php echo $seoinmg ?>">
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
