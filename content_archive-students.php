<?php 
	$terms = get_terms('students_type', 'orderby=id&hide_empty=0&parent=0' );
	$terms1 = get_terms('students_type1', 'orderby=id&hide_empty=0&parent=0' );    
	if (empty($terms[0]))  die('error 0');
	if (empty($terms1[0]))  die('error 0');
	$terms_one = $terms[0];
	$terms_one1 = $terms1[0];
	$lei = !empty($_GET['lei']) ?  strip_tags($_GET['lei']) : $terms_one->slug; 
	$lei1 = !empty($_GET['lei1']) ?  strip_tags($_GET['lei1']) : $terms_one1->slug; 
	$url_bs = '?post_type=students';


?>
<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <ul class="nav nav-tabs" role="tablist">
          	<?php 
			$tab_1 = 1;
			foreach ($terms as $term) 
			{
							
					$lei_url = ''; if (!empty($term->slug))  $lei_url = "&lei={$term->slug}";
					$activ_sel = ($lei== trim($term->slug)) ? 'class="active"' : '';	
					
					$leiurl = ''; if (!empty($lei1)) $leiurl =  "&lei1={$lei1}";
					
				 ?>
                <li role="presentation" <?php echo $activ_sel ?>  ><i></i><a href="<?php echo $url_bs.$lei_url.$leiurl ?>" >
                  <label><?php echo $term->name ?></label>
                  </a></li>
				 <?php 
				$tab_1 ++;
			}
			?>
          </ul>
          <div class="tab-content"> 
            <!--1-->
            <div class="row tab-pane active"  role="tabpanel" id="1">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs nav-tabs-level2" role="tablist">
					<?php 
                    foreach ($terms1 as $term1) 
                    {
                                    
                            $lei_url1 = ''; if (!empty($term1->slug))  $lei_url1 = "&lei1={$term1->slug}";
                            $activ_sel1 = ($lei1== trim($term1->slug)) ? 'class="active"' : '';
                            $leiurl = ''; if (!empty($lei)) $leiurl =  "&lei={$lei}";			
                         ?>
                         <li role="presentation" <?php echo  $activ_sel1 ?>><i></i><a href="<?php echo $url_bs.$lei_url1.$leiurl ?>" >
                            <label><?php echo $term1->name ?></label>
                            </a></li>
                         <?php 
                        
                    }
                    ?>
                </ul>
                <div class="tab-content">

                  <div class="row tab-pane active"  role="tabpanel" id="1_1">
                 		 <div id="neirong">
                         	
                         </div>
                          <input  type="hidden" name="jiazai_tp" id="jiazai_tp" value="students"  />
                          <input  type="hidden" name="jiazai_lei" id="jiazai_lei" value="<?php echo $lei ?>"  />
                           <input  type="hidden" name="jiazai_lei1" id="jiazai_lei1" value="<?php echo $lei1 ?>"  />
                          <input  type="hidden" name="jiazai_page" id="jiazai_page" value="0"  />
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="jiazai">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                                  <button type="button" onclick="load_page();" class="btn btn-lg btn-block btn-blue">加载更多 <i class="glyphicon glyphicon-save"></i></button>
                                </div>
                            </div>
                        </div>
                  </div>

                </div>
                
                
                
                
              </div> 
            </div>
            <!--1 end-->

          </div>
        </div>
      </div>
<script>
function load_page(){
	var jiazai_tp  = $("#jiazai_tp").val();
	var jiazai_lei  = $("#jiazai_lei").val();
	var jiazai_lei1  = $("#jiazai_lei1").val();
	var jiazai_page  = $("#jiazai_page").val();
	$.post(
		'/?post_type=students',
		{
			'ajax_type':'post',
			'jiazai_tp':jiazai_tp,
			'jiazai_lei':jiazai_lei,
			'jiazai_lei1':jiazai_lei1,
			'jiazai_page':jiazai_page
		},
		function(data){
			var json = data.rs;
			//alert(data.rs);	alert(json.length);
			if(json.length == 0)
			{
				$("#jiazai").hide();
			}
			else{
				if(json.length <=2)
				{
					$("#jiazai").hide();
				}
				var html ='';
				
				for(i=0;i<json.length;i++)
				{
					 html += '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" id="uuuuu'+json[i].id+'" >';
					 html += '<div class="picList">';
					 html += '<div class="b-layer"><i class="glyphicon glyphicon-plus"></i></div>';
					 html += '<img src="'+json[i].img_url+'" >';
					 html += '</div>';
					 html += '</div>';
				}
				//alert(html);
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

