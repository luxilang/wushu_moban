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
					$activ_sel = ($tab_1==1) ? 'class="active"' : '';	
				 ?>
                <li role="presentation" <?php echo $activ_sel ?>  ><i></i>
                <a href="#<?php echo $tab_1 ?>"  aria-controls="<?php echo $tab_1 ?>" role="tab" data-toggle="tab">
                  <label><?php echo $term->name ?></label>
                  </a></li>
				 <?php 
				$tab_1 ++;
			}
			?>
          </ul>
          <div class="tab-content"> 
          	<?php 
          	$tab_c = 1;
          	foreach ($terms as $term) 
			{
				$activ_sel = ($tab_c==1) ? 'active' : '';
				?>
            <div class="row tab-pane <?php echo $activ_sel ?>"  role="tabpanel" id="<?php echo $tab_c ?>">
            
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs nav-tabs-level2" role="tablist">
					<?php 
					$tab_2c = 1;
                    foreach ($terms1 as $term1) 
                    {
          
                            $activ_sel1 = ($tab_2c == 1) ? 'class="active"' : '';
                         ?>
                         <li role="presentation" <?php echo  $activ_sel1 ?>><i></i>
                        	<a  href="#<?php echo $tab_c ?>_<?php echo $tab_2c ?>" aria-controls="<?php echo $tab_c ?>_<?php echo $tab_2c ?>" role="tab" data-toggle="tab" >
                            	<label><?php echo $term1->name ?></label>
                            </a>
                          </li>
                         <?php 
                         $tab_2c ++;
                        
                    }
                    ?>
                </ul>
                <div class="tab-content">
                	<?php 
                	$tab_2c = 1;
                	foreach ($terms1 as $term1) 
                    {
                		 $activ_sel2 = ($tab_2c == 1) ? 'active' : '';
                		 $cocccc = $tab_c."_".$tab_2c;
                	?>
		                <div class="row tab-pane <?php echo $activ_sel2 ?>"  role="tabpanel" id="<?php echo $tab_c ?>_<?php echo $tab_2c ?>">
		  
		            		<div id="neirong<?php echo $cocccc ?>">
                         	
                         	</div>
	                          <input  type="hidden" name="jiazai_tp<?php echo $cocccc ?>" id="jiazai_tp<?php echo $cocccc ?>" value="students"  />
	                          <input  type="hidden" name="jiazai_lei<?php echo $cocccc ?>" id="jiazai_lei<?php echo $cocccc ?>" value="<?php echo $term->slug ?>"  />
	                           <input  type="hidden" name="jiazai_lei1<?php echo $cocccc ?>" id="jiazai_lei1<?php echo $cocccc ?>" value="<?php echo $term1->slug ?>"  />
	                          <input  type="hidden" name="jiazai_page<?php echo $cocccc ?>" id="jiazai_page<?php echo $cocccc ?>" value="0"  />
	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="jiazai<?php echo $cocccc ?>">
	                            <div class="row">
	                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
	                                  <button type="button" onclick="load_page<?php echo $cocccc ?>();" class="btn btn-lg btn-block btn-blue">加载更多 <i class="glyphicon glyphicon-save"></i></button>
	                                </div>
	                            </div>
	                        </div>
                        </div>
                        
						<script>
						function load_page<?php echo $cocccc ?>(){
							var jiazai_tp  = $("#jiazai_tp<?php echo $cocccc ?>").val();
							var jiazai_lei  = $("#jiazai_lei<?php echo $cocccc ?>").val();
							var jiazai_lei1  = $("#jiazai_lei1<?php echo $cocccc ?>").val();
							var jiazai_page  = $("#jiazai_page<?php echo $cocccc ?>").val();
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
										$("#jiazai<?php echo $cocccc ?>").show();
									//alert(data.rs);	alert(json.length);
									if(json.length == 0)
									{
										$("#jiazai<?php echo $cocccc ?>").hide();
									}
									else{
										if(json.length <=2)
										{
											$("#jiazai<?php echo $cocccc ?>").hide();
										}
										var html ='';
										var html1 ='';
										var pp= data.page;
										
										for(i=0;i<json.length;i++)
										{
											
											 html += '<a href="'+json[i].img_url_r+'" class="example-image-link" data-lightbox="example-set" data-title=""><div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" id="uuuuu'+json[i].id+'" >';
											 html += '<div class="picList">';
											 html += '<div class="b-layer" data-toggle="modal" ><i class="glyphicon glyphicon-plus"></i></div>';
											 html += '<img src="'+json[i].img_url+'"   width="274" height="370" >';
											 html += '</div>';
											 html += '</div></a>';
											 /*
											 if(i==0 && pp == 1)
											 {
												 html1 += '<div class="item active">';
											 }else{
												 html1 += '<div class="item">';
											 }
											  html1 += '<img src="'+json[i].img_url+'">';
											  html1 += '</div>';
											 */
										}
										//alert(html);
										$("#jiazai_page<?php echo $cocccc ?>").val(data.page);
										if(json.length == 0)
										{
											
										}else{
											$("#neirong<?php echo $cocccc ?>").append(html);	
											$("#neirong1<?php echo $cocccc ?>").append(html1);	
										}
									}
									
								},
								'json'
							)
						
							
						}
						$(document).ready(function() {  
							load_page<?php echo $cocccc ?>();
							$("#jiazai<?php echo $cocccc ?>").hide();
						});
						
						</script>
                        
                      <?php 
                        $tab_2c ++;
                    }
                      ?>
                  </div>

                </div>
              </div> 
				<?php 
				$tab_c  ++;
			}
          	
          	?>
            </div>
            <!--1 end-->
			
          </div >
        </div>
     

