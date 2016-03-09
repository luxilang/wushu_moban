<?php 
	if(!isset($_SESSION['token']) || $_SESSION['token']=='') { 
 		set_token(); 
	} 	
?>
<script src="<?php echo  site_url() ?>/dist/js/My97DatePicker/WdatePicker.js" ></script>
<input name="type_id"  id="type_id"  type="hidden" value="<?php echo $zaixian_submit_type ?>">
<div class="modal fade form-modal" id="yyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <form  id='fff' class="yy-form"  >
        <input name="post_id" id="post_id" type="hidden" value="<?php echo $post_id ?>" />
         <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>"> 
        <!--  
          <div class="form-group">
            <label><i class="red">*</i>家长姓名</label>
            <input type="text" class="" id="jiazhang" placeholder="">
          </div>
          <div class="form-group">
            <label><i class="red">*</i>电话</label>
            <input type="text" class="form-control" id="jiazhuangdianhua" placeholder="">
          </div>form-control
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
          -->
          <div class="form-group">
            <label><i class="red">*</i>孩子姓名</label>
            <input type="text" class="input_kuan" id="xue_name" name='' placeholder="">
          </div>
           <div class="form-group">
            <label><i class="red">*</i>孩子年龄</label>
            <input type="text" class="input_kuan" id="xue_nian" placeholder="">
          </div>
           <div class="form-group">
            <label><i class="red">*</i>联系方式</label>
            <input type="text" class="input_kuan" id="jia_tel" placeholder="">
          </div>
           <div class="form-group">
            <label>性别</label>
            <select  class="input_kuan" id="xingbie" >
            	<option value="">请选择</option>
            	<option value="男" >男</option>
            	<option value="女">女</option>
            </select>
          </div>
           <div class="form-group">
            <label>选择你最近的校区</label>
            <select class="input_kuan"  id="xiaoqu"  >
            	<option value="" >请选择</option>
            	<option value="首都体育学院校区" >首都体育学院校区</option>
            	<option value="海淀体育中心校区" >海淀体育中心校区</option>
            </select>
          </div>
           <div class="form-group">
            <label>想预约什么时间，来免费体验</label>
            <input type="text"  id="yuyuetime"   onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})"  class="input_kuan Wdate"  value=""  placeholder="">
          </div>
            <div class="form-group">
            <label>你所在的区域</label>
            <input type="text" class="input_kuan" id="quyu" placeholder="">
          </div>
           <div class="form-group">
            <label>家长想让孩子学？还是孩子自己喜欢</label>
            <textarea rows="" class="input_kuan"  id="beizhu" cols=""></textarea>
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
		var type_id = $("#type_id").val();
		var xue_name = $("#xue_name").val();
		var xue_nian = $("#xue_nian").val();
		var jia_tel = $("#jia_tel").val();
		var xingbie = $("#xingbie").val();
		var xiaoqu = $("#xiaoqu").val();
		var yuyuetime = $("#yuyuetime").val();
		var quyu = $("#quyu").val();
		var beizhu = $("#beizhu").val();
		if(xue_name == '')
		{
			alert('孩子姓名不能空');
			$("#xue_name")[0].focus(); 
			return false; 
		}
		else if(xue_nian == ''  )
		{ 
			alert('孩子年龄不能空');
			$("#xue_nian")[0].focus();  
			return false; 
		}
		else if(jia_tel == ''  )
		{ 
			alert('联系方式不能空');
			$("#jia_tel")[0].focus();  
			return false; 
		}/*
		else if(!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email)){
			alert('您的电子邮件格式不正确');
			$("#email")[0].focus();  
			return false; 
		}*/
		else 
		{ 
	
			var xue_name = $("#xue_name").val();
			var xue_nian = $("#xue_nian").val();
			var jia_tel = $("#jia_tel").val();
			var xingbie = $("#xingbie").val();
			var xiaoqu = $("#xiaoqu").val();
			var yuyuetime = $("#yuyuetime").val();
			var quyu = $("#quyu").val();
			var beizhu = $("#beizhu").val();
			$.post(
				'/?ajax=single',
				{
					'post_type':'teachers',
					'post_id':post_id,
					'type_id':type_id,
					'xue_name':xue_name,
					'xue_nian':xue_nian,
					'jia_tel':jia_tel,
					'xingbie':xingbie,
					'xiaoqu':xiaoqu,
					'yuyuetime':yuyuetime,
					'quyu':quyu,
					'beizhu':beizhu
				},
				function(data){
					if(data == 1)
					{
						$('#yyModal').modal('hide');
						$('#yycgModal').modal('show') ;
						//var t=setTimeout("$('#yycgModal').modal('hide')",5000);
						countDown(10,'');
					}else if(data == 2){
						alert('邮件发送失败');
					}else if(data == 3){
						alert('短信发送失败');
					}else if(data == 4){
						alert('请不要重复提交');
					}
				},
				'text'
			)
		}
	
}
function countDown(secs,surl){        
 //alert(surl);        
 var jumpTo = document.getElementById('jumpTo');   
 jumpTo.innerHTML=secs;     
 if(--secs>0){        
     setTimeout("countDown("+secs+",'"+surl+"')",1000);        
     }        
 else{   
 	$('#yycgModal').modal('hide') ;
	$("#xue_name").val('');
	$("#xue_nian").val('');
	$("#jia_tel").val('');
	$("#xingbie").val('');
	$("#xiaoqu").val('');
	$("#yuyuetime").val('');
	$("#quyu").val('');
	$("#beizhu").val('');      
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