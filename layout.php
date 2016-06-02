<?php
/*
Template Name: 信息布局模板  
*/ 
function echo_layout($html)
{
	global $post,$post_type_conf,$nav_post_type,$wpdb;
	get_header();

?>
<div class="container">
  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3 page-left hidden-xs">
     <?php echo get_template_part('layout','left');?>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 page-right">
    
    <?php 
			if(is_page())
			{
				
			}else if(is_single()){ //是单页的时候
			
				if (strpos($_SERVER['REQUEST_URI'], 'p_')) {  //导入的文章 
				
					$post_type = get_post_type();
 					$post_type_obj = get_post_type_object(get_post_type());
					
				?>
				<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="class-title">
                    <label><?php 
                      $biaoti_h = get_the_title();
                     echo m_subtext($biaoti_h,30);
                     ?></label>
                    <!--  <ol class="breadcrumb">
                      <li><a href="<?php echo site_url() ?>">首页</a></li>
                      <li><a href="<?php echo site_url() ?>?post_type=<?php echo $post_type ?>"><?php echo $post_type_obj->label ?></a></li>
                      <li class="active"><?php echo get_the_title() ?></li>
                    </ol>-->
                  </div>
                </div>
              </div>
				<?php 
					
				}else{
					
				$post_type = get_post_type();
 				$post_type_obj = get_post_type_object(get_post_type());
				$detail_title_inf = '';
				if($post_type  == 'courses') $detail_title_inf= get_the_title();
				if($post_type  == 'teachers') $detail_title_inf= '教练员介绍';
			
				?>
              <!--title-->
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="class-title">
                    <label><?php  echo $detail_title_inf?></label>
                    <ol class="breadcrumb">
                      <li><a href="<?php echo site_url() ?>">首页</a></li>
                      <li><a href="<?php echo site_url() ?>?post_type=<?php echo $post_type ?>"><?php echo $post_type_obj->label ?></a></li>
                      <li class="active"><?php echo get_the_title() ?></li>
                    </ol>
                  </div>
                </div>
              </div>
				<?php	
				} 

                
				
			}else{
		
        	//print_R(get_post_type_object());
        	/**
        	 * 
        	 * 没有post 数据 就得不到 数据所以改一下
        	 * @var unknown_type
        	 */
        	/**
        		
 				$post_type_obj = get_post_type_object(get_post_type());
 				echo $post_type_obj->label
 				//print_R($post_type_obj);*/
        		//$post_type_get =get_post_type();
			
						?>
                        
                        
                        <?php	
					
        			if (!empty($post_type_conf) && !empty($_GET['post_type'])) {
						$post_type_str_arr = array();
						foreach ($post_type_conf as $value) {
							$post_type_str_arr[$value['post_code']] = $value['post_str'];
						}
						$post_type_str = $post_type_str_arr[$_GET['post_type']];
					
		
        			?> 
                 <!--title-->
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="class-title">
                        <label><?php echo $post_type_str ?></label>
                        <ol class="breadcrumb">
                          <li><a href="<?php echo site_url() ?>">首页</a></li>
                          <li class="active"><?php echo $post_type_str ?></li>
                        </ol>
                      </div>
                    </div>
                  </div>
                    
        			<?php 
					
        		}	
			}
			
			if(is_category())
			{
					?>
                 <!--title-->
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="class-title">
                        <label>所有文章列表</label>
                        <ol class="breadcrumb">
                          <li><a href="<?php echo site_url() ?>">首页</a></li>
                          <li class="active">所有文章列表</li>
                        </ol>
                      </div>
                    </div>
                  </div>
					<?php 
			}
			
	
	?>
    
    
    
     <?php 
    
     require $html; 
     ?>
      <!--map-->
      
      <?php
		$get_post_type_str  = get_post_type();
	  	if(is_page(3))
		{
		//}elseif ($get_post_type_str == 'class_activities'){

		}else{
	  ?>
	  
	  		<!--引用百度地图API-->
						<style type="text/css">
						    html,body{margin:0;padding:0;}
						    .iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
						    .iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
						</style>
						<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
						<div class="row">
							<div class="col-xs-12 page-left hidden-lg hidden-md hidden-sm">
					          <div class="row">
					            <!--三级菜单-->
					            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					              <ul class="level-3-menu">
					                <li><a href="/class_env.html"><i class="class-icon icon-skhj"></i>上课环境</a></li>
			                        <li><a href="/class_time.html"><i class="class-icon icon-sksj"></i>上课时间</a></li>
			                        <li><a href="/class_fee.html"><i class="class-icon icon-kcfy"></i>课程费用</a></li>
			                        <li><a href="/class_activities.html"><i class="class-icon icon-yhhd"></i>优惠活动</a></li>
					                <div class="clearfix"></div>
					              </ul>
					            </div>
					          </div>
					        </div>
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="map-box">
						<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title"><label>分校信息</label></div>
						<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
							<div style="height:326px;border:#ccc solid 1px;" id="dituContent"></div>
						</div>
						
						<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
						<ul class="address-list">
							<?php 
							
					
							
							$rs_school_info = $wpdb->get_results("select * from wp_posts where  post_status = 'publish'  and  post_type = 'school_info'   order by ID desc " );
							if (!empty($rs_school_info)) {
					
								foreach ($rs_school_info as $key => $rs_school_o) {
									
							?>
							<li>
								<div class="map-info">
								<h3><?php echo $rs_school_o->post_title  ?></h3>
								<label>详细地址：<?php echo get_post_meta($rs_school_o->ID,'_school_ad',true);  ?></label>
								<label>联系电话：<?php echo get_post_meta($rs_school_o->ID,'_school_phone',true);  ?></label>
								<label>乘车路线：<?php echo get_post_meta($rs_school_o->ID,'_school_bus_line',true);  ?></label>
								<?php 
								$school_tiebus_line = get_post_meta($rs_school_o->ID,'_school_tiebus_line',true);
								if (!empty($school_tiebus_line)) {
									?>
									<label>地铁路线：<?php echo  $school_tiebus_line ?></label>
									<?php 

								}
								?>
								
								<a href='/map.php?type=<?php echo $rs_school_o->ID  ?>' target='_blank'><i class="icon-maps icon-mark"></i>查询地图</a>
								<a href='/map.php?type=<?php echo $rs_school_o->ID  ?>' target= '_blank'><i class="icon-maps icon-car"></i>公交/驾车去这里</a>
								</div>
							</li>
		                	<?php 
								}
							}
		                	?>
						</ul>
						</div>
						</div>
						</div>
						</div>
						</div>
						 <style type="text/css">
						        body { background-image:url(text.txt); background-attachment:fixed; height:1000px; }
						 #bottomNavfit { z-index:999; position:fixed; bottom:0; left:0; width:100%; _position:absolute;
						 _top: expression_r(documentElement.scrollTop + documentElement.clientHeight-this.offsetHeight); overflow:visible; }
						    </style>
						<div id="bottomNavfit"> 
						<div class="col-xs-6 hidden-lg hidden-md hidden-sm"><button class="btn btn-blue btn-block"><i class="glyphicon glyphicon-phone"></i><a href="tel:18911639063" style='color:#fff'>联系电话</a></button></div>
                    	<div class="col-xs-6 hidden-lg hidden-md hidden-sm"><button class="btn btn-blue btn-block"><i class="glyphicon glyphicon-comment"></i><a href="sms:18911639063" style='color:#fff'>短信联系</a></button></div>
						</div>
						
						<script type="text/javascript">
						        //创建和初始化地图函数：
						    function initMap(){
						        createMap();//创建地图
						        setMapEvent();//设置地图事件
						        addMapControl();//向地图添加控件
						        addMarker();//向地图中添加marker
						    }
						    
						    //创建地图函数：
						    function createMap(){
						        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
						       var point = new BMap.Point(116.338695,39.985165);//定义一个中心点坐标
						        map.centerAndZoom(point,12);//设定地图的中心点和坐标并将地图显示在地图容器中
						        window.map = map;//将map变量存储在全局
						    }
						    
						    //地图事件设置函数：
						    function setMapEvent(){
						        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
						        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
						        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
						        map.enableKeyboard();//启用键盘上下左右键移动地图
						    }
						    
						    //地图控件添加函数：
						    function addMapControl(){
						        //向地图中添加缩放控件
							var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
							map.addControl(ctrl_nav);
						                //向地图中添加比例尺控件
							var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
							map.addControl(ctrl_sca);
						    }
						    
						    //标注点数组
						  var markerArr = [
							<?php 
							      	$all_rs_len  = count($rs_school_info);
							        foreach ($rs_school_info as $key => $value) {
							        	$school_map_point_x = get_post_meta($value->ID,'_school_map_point_x',true);
							        	$school_map_point_y = get_post_meta($value->ID,'_school_map_point_y',true);
							        	if ((!empty($school_map_point_x))  && (!empty($school_map_point_y))) 
							        	{
							        	
							        	$school_map_content = get_post_meta($value->ID,'_school_map_title',true).'<br/>';
										$school_map_content .= get_post_meta($value->ID,'_school_phone',true); 
							        	$key ++;
							        	if ($key == $all_rs_len) {
							        		?>
							         		{title:"<?php echo  get_post_meta($value->ID,'_school_map_title',true);  ?>",content:"<?php echo $school_map_content  ?>",point:"<?php echo  $school_map_point_x ?>|<?php echo  $school_map_point_y  ?>",isOpen:0,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
							        		<?php
							        	}else{
										?>
						         		{title:"<?php echo  get_post_meta($value->ID,'_school_map_title',true);  ?>",content:"<?php echo $school_map_content  ?>",point:"<?php echo  $school_map_point_x  ?>|<?php echo  $school_map_point_y  ?>",isOpen:0,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}},
						        		<?php 
										}

							        	}
									 }
							        ?>
								 ];
						    //创建marker
						    function addMarker(){
						        for(var i=0;i<markerArr.length;i++){
						            var json = markerArr[i];
						            var p0 = json.point.split("|")[0];
						            var p1 = json.point.split("|")[1];
						            var point = new BMap.Point(p0,p1);
									var iconImg = createIcon(json.icon);
						            var marker = new BMap.Marker(point);
									var iw = createInfoWindow(i);
									var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
									marker.setLabel(label);
						            map.addOverlay(marker);
						            label.setStyle({
						                        borderColor:"#808080",
						                        color:"#333",
						                        cursor:"pointer"
						            });
									
									(function(){
										var index = i;
										var _iw = createInfoWindow(i);
										var _marker = marker;
										_marker.addEventListener("click",function(){
										    this.openInfoWindow(_iw);
									    });
									    _iw.addEventListener("open",function(){
										    _marker.getLabel().hide();
									    })
									    _iw.addEventListener("close",function(){
										    _marker.getLabel().show();
									    })
										label.addEventListener("click",function(){
										    _marker.openInfoWindow(_iw);
									    })
										if(!!json.isOpen){
											label.hide();
											_marker.openInfoWindow(_iw);
										}
									})()
						        }
						    }
						    //创建InfoWindow
						    function createInfoWindow(i){
						        var json = markerArr[i];
						        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
						        return iw;
						    }
						    //创建一个Icon
						    function createIcon(json){
						        var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
						        return icon;
						    }
						    
						    initMap();//创建和初始化地图
						</script>
     		 <?php  
     		 // echo $content = get_post('5')->post_content;  
     		   ?>
      	<?php
		}
		?>
    </div>

  </div>
</div>
<?php 
	get_footer();
}
?>