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
			$menu_i = 1;
			foreach ($menu_arr as $key=> $value) {
 
				$activ_sel = ($menu_i == 1) ? 'class="active"' : '';	
				?>
            <li role="presentation" <?php echo $activ_sel ?> ><i></i><a  href="#<?php echo $menu_i ?>" aria-controls="<?php echo $menu_i ?>" role="tab" data-toggle="tab"  >
              <label><?php echo $key ?></label>
              </a></li>
            <?php
            	$menu_i ++;
			}

			?>
          </ul>
          <div class="tab-content"> 
    		<?php 
    		$menu_i = 1;
    		foreach ($menu_arr as $key=> $value) 
    		{
    			$activ_sel = ($menu_i == 1) ? 'active' : '';
    		?>
            <div class="row tab-pane <?php echo $activ_sel ?>"  role="tabpanel"    id="<?php echo $menu_i ?>" >
                    <div id="neirong<?php echo $menu_i ?>">
                          <?php
                    	$args['posts_per_page'] = 3;
						$args['offset'] = 0;
						$args['post_type'] = 'teachers';
						if(!empty($value))
						{
							$args['tax_query'] =  array(
									'relation' => 'AND',
									array(
										'taxonomy' => 'teachers_type',
										'field'    => 'slug',
										'terms'    => array( "$value"),
									),
							);
						}
						
						$query = new WP_Query( $args );
				
						if (!empty($query->posts)) {
							$rs = $query->posts;	
							foreach ($rs as $rs_o) {	
										$img_url = get_post_meta($rs_o->ID,'_id_upload_teachers',true);
										//$img_url = site_url()."/wp-content/uploads/timthumb.php?src=".site_url().$img_url."&w=212&h=212".get_timthumb_cf();
										$img_url = my_thumb_img($img_url,"&w=212&h=212".get_timthumb_cf());
										?>
									<div class="col-lg-4 col-md-4 col-sm-4">
									<div class="blue-box"> <img src="<?php echo $img_url ?>" alt="<?php echo $rs_o->post_title ?>"  width="212" height="212">
									<label><?php echo $rs_o->post_title ?></label>
									<p><?php echo get_post_meta($rs_o->ID,'_teachers_yddj',true)  ?></p>
									<p>少儿武术教学经验:<?php echo get_post_meta($rs_o->ID,'_teachers_sewsjljy',true)  ?></p>
									<p>教学风格:<?php echo get_post_meta($rs_o->ID,'_teachers_jxfg',true)  ?></p>
									
									<a href="<?php echo get_permalink($rs_o->ID) ?>"><i class="glyphicon glyphicon-menu-right"></i>查看详情</a>
									</div>
									</div>
										<?php
							
							}
							wp_reset_postdata();
						}
						?>
                    </div>
              
                    
                    <input  type="hidden" name="jiazai_tp<?php echo $menu_i ?>" id="jiazai_tp<?php echo $menu_i ?>" value="teachers"  />
                    <input  type="hidden" name="jiazai_lei<?php echo $menu_i ?>" id="jiazai_lei<?php echo $menu_i ?>" value="<?php echo $value ?>"  />
                    <input  type="hidden" name="jiazai_page<?php echo $menu_i ?>" id="jiazai_page<?php echo $menu_i ?>" value="1"  />


                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="jiazai<?php echo $menu_i ?>">		
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
												html += ' <div class="blue-box"> <img src="'+json[i].img_url+'" alt="'+json[i].title+'"  width="212" height="212">';
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
								
							
							});
							</script>
            </div>
            
            
			<?php 
				$menu_i ++;
    		}
			?>
        
          </div>
        </div>
      </div>


