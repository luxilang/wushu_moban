<input name="type_id"  id="type_id"  type="hidden" value="<?php echo $zaixian_submit_type ?>">
<div class="modal fade form-modal" id="yyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <form  id='fff' class="yy-form"  >
        <input name="post_id" id="post_id" type="hidden" value="<?php echo $post_id ?>" />
          <div class="form-group">
            <label><i class="red">*</i>家长姓名</label>
            <input type="text" class="form-control" id="jiazhang" placeholder="">
          </div>
          <div class="form-group">
            <label><i class="red">*</i>电话</label>
            <input type="text" class="form-control" id="jiazhuangdianhua" placeholder="">
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
		var type_id = $("#type_id").val();
		var jiazhuang = $("#jiazhang").val();
		var jazhangdianhua = $("#jiazhuangdianhua").val();
		var email = $("#email").val();
		var xueyuan = $("#xueyuan").val();
		var nianling = $("#nianling").val();
		if(jiazhuang == '')
		{
			alert('家长姓名不能空');
			$("#jiazhang")[0].focus(); 
			return false; 
		}
		else if(jazhangdianhua == ''  )
		{ 
			alert('电话不能空');
			$("#jiazhuangdianhua")[0].focus();  
			return false; 
		}
		else if(email == ''  )
		{ 
			alert('邮件不能空');
			$("#email")[0].focus();  
			return false; 
		}
		else if(!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email)){
			alert('您的电子邮件格式不正确');
			$("#email")[0].focus();  
			return false; 
		}
		else if(xueyuan == ''  )
		{ 
			alert('学员姓名不能空');
			$("#xueyuan")[0].focus();  
			return false; 
		}
		else if(nianling == ''  )
		{ 
			alert('学员年龄不能空');
			$("#nianling")[0].focus();  
			return false; 
		}
		else 
		{ 
			
			$.post(
				'/?ajax=single',
				{
					'post_type':'teachers',
					'post_id':post_id,
					'type_id':type_id,
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