<?php $post_type = get_post_type(); ?>
      <div class="row">
      	<?php echo $content = get_post('19')->post_content;    ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <ul class="nav nav-tabs" role="tablist">
   		 <?php 
			/***
			$terms = get_terms('teachers_type', 'orderby=name&hide_empty=0&parent=0' ); 	
			
			$terms_arr = array();
			foreach ($terms as $value) {
				$terms_arr[$value->name] = $value->slug;
			}*/
			//var_export($terms_arr);
			$lei = !empty($_GET['lei']) ?  strip_tags($_GET['lei']) : ''; 
			$menu_arr = array (
			  '全部教练员' => '',
			  '太极拳教练员' => 'jl_taijiquan',
			  '散打教练员' => 'jl_sd',
			  '武术教练员' => 'jl_wush',
			  '空翻教练员' => 'jl_kongfan',
			  '跆拳道教练员' => 'jl_taiquandao',
			);

			foreach ($menu_arr as $key=> $value) {
 			
				$lei_url = '';
				if (!empty($value)) {
					$lei_url = "&lei={$value}";
				}
				$activ_sel = ($lei== trim($value)) ? 'class="active"' : '';	
				?>
            <li role="presentation" <?php echo $activ_sel ?> ><i></i><a href="/?post_type=teachers<?php echo $lei_url ?>"  >
              <label><?php echo $key ?></label>
              </a></li>
            <?php
			}

			?>
          </ul>
          <div class="tab-content"> 
           
            <div class="row tab-pane active"  role="tabpanel"   >
                    <div id="neirong">
                    
                    </div>
                         <input  type="hidden" name="jiazai_tp" id="jiazai_tp" value="teachers"  />
                    <input  type="hidden" name="jiazai_lei" id="jiazai_lei" value="<?php echo $lei ?>"  />
                      <input  type="hidden" name="jiazai_page" id="jiazai_page" value="0"  />
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="jiazai">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                            <button type="button" onclick="load_page()" class="btn btn-lg btn-block btn-blue">加载更多 <i class="glyphicon glyphicon-save"></i></button>
                        </div>
                    </div>
                    </div>
          		
            </div>

            <!--tab end--> 
          </div>
        </div>
      </div>

<script>
function load_page(){
	var jiazai_tp  = $("#jiazai_tp").val();
	var jiazai_lei  = $("#jiazai_lei").val();
	var jiazai_page  = $("#jiazai_page").val();
	$.post(
		'/?post_type=teachers',
		{
			'ajax_type':'post',
			'jiazai_tp':jiazai_tp,
			'jiazai_lei':jiazai_lei,
			'jiazai_page':jiazai_page
		},
		function(data){
			var json = data.rs;
			if(json.length ==0)
			{
				$("#jiazai").hide();
			}else{
				//alert(data.rs);	alert(json.length);
				if(json.length <=2)
				{
					$("#jiazai").hide();
				}
				var html ='';
				for(i=0;i<json.length;i++)
				{
					html += '<div class="col-lg-4 col-md-4 col-sm-4">';
					html += ' <div class="blue-box"> <img src="'+json[i].img_url+'" width="212" height="212">';
					html += '<label>'+json[i].title+'</label>';
					html += '<p>'+json[i].yddj+'</p>';
					html += '<p>少儿武术教学经验:'+json[i].sewsjljy+'</p>';
					html += '<p>教学风格:'+json[i].jxfg+'</p>';
					
					html += '<a href="'+json[i].permalink+'"><i class="glyphicon glyphicon-menu-right"></i>查看详情</a>';
					html += '</div>';
					html += '</div>';
				}
			
				$("#jiazai_page").val(data.page);
				if(json.length == 0)
				{
					
				}else{
					$("#neirong").append(html);	
				}

			}
		},
		'json'
	)

	
}
$(document).ready(function() {  

		load_page();

});




</script>
