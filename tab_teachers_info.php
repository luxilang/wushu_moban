 <style>
								#jiaoliang_info { margin-bottom:1%}
								#jiaoliang_info li {
									margin-right: 0.5%;
									
								}
								.view-detail .tab-content-view .blue-box, .teachers .blue-box{
										min-height: 440px
								}
								</style>
								 <ul class="nav nav-tabs nav-tabs-level2" role="tablist" id='jiaoliang_info'>
                			<?php 
                			
                			$menu_arr = array (
								  '全部教练员' => '',
								  '太极拳教练员' => 'jl_taijiquan',
								  '散打教练员' => 'jl_sd',
								  '武术教练员' => 'jl_wush',
								  '空翻教练员' => 'jl_kongfan',
								  '跆拳道教练员' => 'jl_taiquandao',
								);
								
							//菜单部分
                			$menu_i = 1;
							foreach ($menu_arr as $key=> $value) {
				 
								$activ_sel = ($menu_i == 1) ? 'class="active"' : '';	
								
                			?>

					      
		                    <li role="presentation" <?php echo $activ_sel ?>><i></i><a href="#4_<?php echo $menu_i ?>" aria-controls="4_<?php echo $menu_i ?>" role="tab" data-toggle="tab">
							  <label><?php echo $key ?></label>
							  </a></li>
							<?php 
							           
				            	$menu_i ++;
							}
							//教练
							?>
							</ul>
								<div class="tab-content"> 
								    	<?php 
							    		$menu_i = 1;
							    		foreach ($menu_arr as $key=> $value) 
							    		{
							    			$activ_sel = ($menu_i == 1) ? 'active' : '';
							    		?>
										<div class="row tab-pane <?php echo $activ_sel ?>"  role="tabpanel" id="4_<?php echo $menu_i ?>">
											<div id="neirong<?php echo $menu_i ?>">
                    
                   							 </div>
                   							
						                   	<input  type="hidden" name="jiazai_tp<?php echo $menu_i ?>" id="jiazai_tp<?php echo $menu_i ?>" value="teachers"  />
						                    <input  type="hidden" name="jiazai_lei<?php echo $menu_i ?>" id="jiazai_lei<?php echo $menu_i ?>" value="<?php echo $value ?>"  />
						                      <input  type="hidden" name="jiazai_page<?php echo $menu_i ?>" id="jiazai_page<?php echo $menu_i ?>" value="0"  />
			
												 <div style='margin-top: 0.5%;' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="jiazai<?php echo $menu_i ?>">
							                        <div class="row">
							                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
							                            <button type="button" onclick="load_page<?php echo $menu_i ?>()" class="btn btn-lg btn-block btn-blue">加载更多 <i class="glyphicon glyphicon-save"></i></button>
							                          </div>
							                        </div>
							                     </div>
											  <script>
												function load_page<?php echo $menu_i ?>(){
													var jiazai_tp  = $("#jiazai_tp<?php echo $menu_i ?>").val();
													var jiazai_lei  = $("#jiazai_lei<?php echo $menu_i ?>").val();
													var jiazai_page  = $("#jiazai_page<?php echo $menu_i ?>").val();
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
																$("#jiazai<?php echo $menu_i ?>").hide();
															}else{
																//alert(data.rs);	alert(json.length);
																if(json.length <=2)
																{
																	$("#jiazai<?php echo $menu_i ?>").hide();
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
															
																$("#jiazai_page<?php echo $menu_i ?>").val(data.page);
																if(json.length == 0)
																{
																	
																}else{
																	$("#neirong<?php echo $menu_i ?>").append(html);	
																}
												
															}
														},
														'json'
													)
												
													
												}
												$(document).ready(function() {  
												
														load_page<?php echo $menu_i ?>();
												
												});
												</script>
										</div>
											<?php 
											$menu_i ++;
							    		}
										?>
								  </div>
							
							