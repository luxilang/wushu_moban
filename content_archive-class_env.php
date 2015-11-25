<link rel="stylesheet" href="<?php echo  site_url() ?>/lightbox/css/lightbox.css">
<script src="<?php echo  site_url() ?>/lightbox/js/lightbox.js"></script>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <ul class="nav nav-tabs" role="tablist">
                 <?php

$terms = get_terms('class_env_type', 'orderby=name&hide_empty=0&parent=0' );  
if (empty($terms[0]))  die('error 0');
$terms_one = $terms[0];

$lei = !empty($_GET['lei']) ?  strip_tags($_GET['lei']) : $terms_one->slug; 
$url_bs = '?post_type=class_env';

foreach ($terms as $term) 
{
				$lei_url = '';
				if (!empty($term->slug)) 
				{
					$lei_url = "&lei={$term->slug}";
				}
				
				
				 $activ_sel = ($lei== trim($term->slug)) ? 'class="active"' : '';			
	 ?>
            <li role="presentation"  <?php echo  $activ_sel ?> ><i></i><a href="<?php echo $url_bs.$lei_url ?>" >
              <label> <?php echo $term->name ?></label>
              </a></li>

              	 <?php 
	
}
?>
          </ul>
          <div class="tab-content">
            <div class="row tab-pane active"  role="tabpanel" >
               	 		<div id="neirong"></div>
                         <input  type="hidden" name="jiazai_tp" id="jiazai_tp" value="class_env"  />
                    <input  type="hidden" name="jiazai_lei" id="jiazai_lei" value="<?php echo $lei ?>"  />
                      <input  type="hidden" name="jiazai_page" id="jiazai_page" value="0"  />
              	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  id="jiazai">
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
			$("#jiazai").show();
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
					 html += '<a href="'+json[i].img_url+'" class="example-image-link" data-lightbox="example-set" data-title=""><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">';
					 html += '<div class="picList">';
					 html += '<div class="b-layer"><i class="glyphicon glyphicon-plus"></i></div>';
					 html += '<img src="'+json[i].img_url+'" >';
					 html += '</div>';
					 html += '</div></a>';
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
		$("#jiazai").hide();	
});




</script>				
						