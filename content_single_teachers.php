<?php 
$post_id = $post->ID; 
$img_url = get_post_meta($post_id,'_id_upload_teachers',true); 
?>
<div class="row content">
      	<div class="col-lg-12">
        	<div class="row view-info">
            	<div class="col-lg-4 col-xs-6 col-lg-offset-0 col-xs-offset-3">
                	<img src="<?php echo $img_url  ?>">
                </div>
                <div class="col-lg-8 col-xs-12">
                	<h3><?php echo $post->post_title ?></h3>
                    <label><span>姓名：</span><?php echo get_post_meta($post_id,'_teachers_name',true); ?></label>
                    <label><span>习武年限：</span><?php echo get_post_meta($post_id,'_teachers_xwnx',true);  ?></label>
                    <label><span>武术段位：</span><?php echo get_post_meta($post_id,'_teachers_wsdw',true);  ?></label>
                    <label><span>运动等级：</span><?php echo get_post_meta($post_id,'_teachers_yddj',true);  ?></label>
                    <label><span>武术最高级别：</span><?php echo get_post_meta($post_id,'_teachers_wszgjb',true);  ?></label>
                    <label><span>少儿武术教学经验：</span><?php echo get_post_meta($post_id,'_teachers_sewsjljy',true);  ?></label>
                    <label><span>毕业于：</span><?php echo get_post_meta($post_id,'_teachers_by',true);  ?></label>
                    <label class="fg">教学风格：<?php echo get_post_meta($post_id,'_teachers_jxfg',true);  ?></label>
                    <button type="button" class="btn btn-blue btn-lg" data-toggle="modal" data-target="#yyModal"><i class="glyphicon glyphicon-plus"></i>我要体验<span class="bubble">预约</span></button>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="view-detail">
              <ul class="nav nav-tabs nav-tabs-view" role="tablist">
              
         <?php 

	$ashu_teachers_tab_arr = get_option('ashu_teachers_tab');
	$teachers_tab_ini = trim($ashu_teachers_tab_arr['_teachers_tab_ini']);
				if (!empty($teachers_tab_ini)) {
				
					$teachers_tab_ini_arr = array_filter(explode("\r\n", $teachers_tab_ini));
					if (!empty($teachers_tab_ini_arr)) {
						foreach ($teachers_tab_ini_arr as $key => $value) {
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
			  	if (!empty($teachers_tab_ini_arr)) {
						foreach ($teachers_tab_ini_arr as $key => $value) {
							$tab_id1 = $key+1;
							if (!empty($value)) {
								list($tab_option_name,$tab_option_id,$tab_option_desc) =  explode("|", $value);
								
								$active_tab1 = ($key==0)   ?  'active' : ''; 
								
			  ?>

                <div class="row tab-pane <?php echo $active_tab1 ?>"  role="tabpanel" id="<?php echo $tab_id1 ?>">
                		<?php echo get_post_meta($post_id,$tab_option_id,true); ?>
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


<div class="modal fade form-modal" id="yyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <form class="yy-form">
        <input name="post_id" id="post_id" type="hidden" value="<?php echo $post_id ?>" />
          <div class="form-group">
            <label><i class="red">*</i>家长姓名</label>
            <input type="text" class="form-control" id="jiazhuang" placeholder="">
          </div>
          <div class="form-group">
            <label><i class="red">*</i>电话</label>
            <input type="text" class="form-control" id="jazhangdianhua" placeholder="">
          </div>
          <div class="form-group">
            <label><i class="red">*</i>Email</label>
            <input type="email" class="form-control" id="email" placeholder="">
          </div>
          <div class="form-group">
            <label><i class="red">*</i>学员姓名</label>
            <input type="text" class="form-control" id="xueyuan" placeholder="">
          </div>
          <div class="form-group">
            <label><i class="red">*</i>学员年龄</label>
            <input type="text" class="form-control" id="nianling" placeholder="">
          </div>
          <button type="button" class="btn btn-blue btn-block btn-lg"   onclick="tijiao()" >提交</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
function tijiao(){
		var post_id = $("#post_id").val();
		var jiazhuang = $("#jiazhuang").val();
		var jazhangdianhua = $("#jazhangdianhua").val();
		var email = $("#email").val();
		var xueyuan = $("#xueyuan").val();
		var nianling = $("#nianling").val();
		$.post(
		'/?ajax=single',
		{
			'post_type':'teachers',
			'post_id':post_id,
			'jiazhuang':jiazhuang,
			'jazhangdianhua':jazhangdianhua,
			'email':email,
			'xueyuan':xueyuan,
			'nianling':nianling
		},
		function(data){
			if(data == 1)
			{
				$('#yyModal').modal('hide');
				$('#yycgModal').modal('show') ;
				//var t=setTimeout("$('#yycgModal').modal('hide')",5000);
				countDown(10,'');
			}
		},
		'text'
	)
	
}
function countDown(secs,surl){        
 //alert(surl);        
 var jumpTo = document.getElementById('jumpTo');   
 jumpTo.innerHTML=secs;     
 if(--secs>0){        
     setTimeout("countDown("+secs+",'"+surl+"')",1000);        
     }        
 else{   
 	$('#yycgModal').modal('hide')       
     //location.href=surl;        
     }        
 }        
</script>  
</script>

<div class="modal fade form-modal" id="yycgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <form class="yycg-form text-center">
          <img src="/dist/img/yy-logo.png">
          <label>恭喜您提交成功，<br>我们的客服人员将会在1-2个工作日内与您联系！</label>
          <span>页面将在<span id="jumpTo" style="display:inline">10</span>秒后自动跳转到</span>
          
        </form>
      </div>
    </div>
  </div>
</div>