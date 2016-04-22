
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <ul class="nav nav-tabs" role="tablist">
                 <?php

$terms = get_terms('class_env_type', 'orderby=name&hide_empty=0&parent=0' );  
if (empty($terms[0]))  die('error 0');
$terms_one = $terms[0];

$lei = !empty($_GET['lei']) ?  strip_tags($_GET['lei']) : $terms_one->slug; 
$url_bs = '?post_type=class_env';
$terms_i = 1;
foreach ($terms as $term) 
{
				 $activ_sel = ($terms_i == 1) ? 'class="active"' : '';			
	 ?>
            <li role="presentation"  <?php echo  $activ_sel ?> ><i></i><a href="#<?php echo $terms_i ?>" aria-controls="<?php echo $terms_i ?>" role="tab" data-toggle="tab" >
              <label> <?php echo $term->name ?></label>
              </a></li>

              	 <?php 
	$terms_i ++;
}
?>
          </ul>
          <div class="tab-content">
          	<?php 
          	$terms_i = 1;
          	foreach ($terms as $term) 
			{
				 $activ_sel = ($terms_i == 1) ? 'active' : '';			
				 ?>
        
            <div class="row tab-pane <?php echo $activ_sel ?>"  role="tabpanel"  id="<?php echo $terms_i ?>">
               	 		<div id="neirong<?php echo $terms_i ?>"></div>
                         <input  type="hidden" name="jiazai_tp<?php echo $terms_i ?>" id="jiazai_tp<?php echo $terms_i ?>" value="class_env"  />
                    <input  type="hidden" name="jiazai_lei<?php echo $terms_i ?>" id="jiazai_lei<?php echo $terms_i ?>" value="<?php echo $term->slug ?>"  />
                      <input  type="hidden" name="jiazai_page<?php echo $terms_i ?>" id="jiazai_page<?php echo $terms_i ?>" value="0"  />
              	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  id="jiazai<?php echo $terms_i ?>">
                        <div class="row">
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                            <button type="button" onclick="load_page<?php echo $terms_i ?>()" class="btn btn-lg btn-block btn-blue">加载更多 <i class="glyphicon glyphicon-save"></i></button>
                          </div>
                        </div>
                      </div>
            </div>
            
				<script>
				function load_page<?php echo $terms_i ?>(){
					var jiazai_tp  = $("#jiazai_tp<?php echo $terms_i ?>").val();
					var jiazai_lei  = $("#jiazai_lei<?php echo $terms_i ?>").val();
					var jiazai_page  = $("#jiazai_page<?php echo $terms_i ?>").val();
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
							$("#jiazai<?php echo $terms_i ?>").show();
							if(json.length ==0)
							{
								$("#jiazai<?php echo $terms_i ?>").hide();
							}else{
								//alert(data.rs);	alert(json.length);
								if(json.length <=2)
								{
									$("#jiazai<?php echo $terms_i ?>").hide();
								}
								var html ='';
								for(i=0;i<json.length;i++)
								{
									 html += '<a href="'+json[i].img_url+'" class="example-image-link" data-lightbox="example-set" data-title=""><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">';
									 html += '<div class="picList">';
									 html += '<div class="b-layer"><i class="glyphicon glyphicon-plus"></i></div>';
									 html += '<img src="'+json[i].img_url+'" alt="'+json[i].title+'" >';
									 html += '</div>';
									 html += '</div></a>';
								}
							
								$("#jiazai_page<?php echo $terms_i ?>").val(data.page);
								if(json.length == 0)
								{
									
								}else{
									$("#neirong<?php echo $terms_i ?>").append(html);	
								}
				
							}
						},
						'json'
					)
				
					
				}
				$(document).ready(function() {  
				
						load_page<?php echo $terms_i ?>();
						$("#jiazai<?php echo $terms_i ?>").hide();	
				});
				</script>	
			<?php 
				$terms_i ++;
			}
			?>
          </div>
        </div>
      </div>

			
						