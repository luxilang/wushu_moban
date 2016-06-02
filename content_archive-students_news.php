<?php 
	global $wpdb;
	$wp_ngg_album = $wpdb->get_row("SELECT * FROM wp_ngg_album  WHERE name = '学员风采' ");
	
	$gid_ls = unserialize($wp_ngg_album->sortorder);
	$gid_ls_str = join(",",$gid_ls);	
	
	$wp_ngg_gallery = $wpdb->get_results("SELECT * FROM wp_ngg_gallery WHERE  gid  IN($gid_ls_str)  order by field(gid,$gid_ls_str)  ");

	$curr_gallery = $wp_ngg_gallery[0];

	$curr_gid = $curr_gallery->gid;
	//$tag_items = get_terms('ngg_tag', 'ignore_empty=true' );   

	$arr_tag = array(
			'训练花絮',
			'比赛锦集',
			'获奖证书',
		    '学员表演'
	);

?>
<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <ul class="nav nav-tabs" role="tablist">

          
          	<?php 
			$tab_1 = 1;
			foreach ($wp_ngg_gallery as $term) 
			{
					$activ_sel = ($tab_1==1) ? 'class="active"' : '';	
				 ?>
                <li role="presentation" <?php echo $activ_sel ?>  ><i></i>
                <a href="#<?php echo $tab_1 ?>"  aria-controls="<?php echo $tab_1 ?>" role="tab" data-toggle="tab">
                  <label><?php echo $term->title ?></label>
                  </a></li>
				 <?php 
				$tab_1 ++;
			}
			?>
          </ul>
          
          <div class="tab-content"> 
          	<?php 
          	$tab_c = 1;
          	foreach ($wp_ngg_gallery as $term) 
			{
				$activ_sel = ($tab_c==1) ? 'active' : '';
				?>
            <div class="row tab-pane <?php echo $activ_sel ?>"  role="tabpanel" id="<?php echo $tab_c ?>">
            
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs nav-tabs-level2" role="tablist">
					<?php 
					$tab_2c = 1;
                    foreach ($arr_tag as $term_tag) 
                    {
          
                            $activ_sel1 = ($tab_2c == 1) ? 'class="active"' : '';
                         ?>
                         <li role="presentation" <?php echo  $activ_sel1 ?>><i></i>
                        	<a  href="#<?php echo $tab_c ?>_<?php echo $tab_2c ?>" aria-controls="<?php echo $tab_c ?>_<?php echo $tab_2c ?>" role="tab" data-toggle="tab" >
                            	<label><?php echo $term_tag ?></label>
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
                	foreach ($arr_tag as $term_tag) 
                    {
                		 $activ_sel2 = ($tab_2c == 1) ? 'active' : '';
                		 $cocccc = $tab_c."_".$tab_2c;
                	?>
		                <div class="row tab-pane <?php echo $activ_sel2 ?>"  role="tabpanel" id="<?php echo $tab_c ?>_<?php echo $tab_2c ?>">
		  
		            		<div id="neirong<?php echo $cocccc ?>">
		            			<?php 

				 	$curr_gid = $term->gid ;
				 	$curr_tag_str = $term_tag;
				 	
				 	$sql = "
					SELECT wp_ngg_gallery.name AS dirname,wp_ngg_pictures.* FROM  wp_ngg_pictures 
					LEFT JOIN wp_ngg_gallery ON  wp_ngg_gallery.gid = wp_ngg_pictures.galleryid
					LEFT JOIN  
					wp_term_relationships  ON 
					wp_term_relationships.object_id  = wp_ngg_pictures.pid
					LEFT JOIN
					wp_term_taxonomy
					ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
					LEFT JOIN 
					wp_terms 
					ON  wp_terms.term_id = wp_term_taxonomy.term_id
					
					WHERE wp_term_taxonomy.taxonomy = 'ngg_tag'  AND wp_terms.name = '{$curr_tag_str}'  AND wp_ngg_pictures.galleryid = '{$curr_gid}'  limit 0,3
				 	";
			
				 	$pictures = $wpdb->get_results($sql);
				
					
				 	foreach ($pictures as $picture) {
						$img_url = "/wp-content/gallery/".$picture->dirname."/".$picture->filename;
						$img_url_r = "/wp-content/gallery/".$picture->dirname."/".$picture->filename;
						//$img_thumbs = "/wp-content/gallery/".$picture->dirname."/thumbs/thumbs_".$picture->filename;\
						
						
						$img_thumbs = site_url()."/wp-content/uploads/timthumb.php?src=".site_url().$img_url."&w=274&h=370".get_timthumb_cf();
						$img_url_r = ($img_url_r == '') ? $img_url : $img_url_r;
						$title = $picture->alttext;
						
		            			?>
								 <a href="<?php echo $img_url_r ?>" class="example-image-link" data-lightbox="example-set" data-title=""><div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" id="uuuuu<?php echo  $picture->pid ?>" >
									 <div class="picList">
									 <div class="b-layer" data-toggle="modal" ><i class="glyphicon glyphicon-plus"></i></div>
									 <img src="<?php echo $img_thumbs ?>" alt="<?php echo $title  ?>"   >
									 </div>
									 </div>
								 </a>
								 <?php 
				 	}
								 ?>
                         	</div>
	                          <input  type="hidden" name="jiazai_tp<?php echo $cocccc ?>" id="jiazai_tp<?php echo $cocccc ?>" value="students"  />
	                          <input  type="hidden" name="jiazai_lei<?php echo $cocccc ?>" id="jiazai_lei<?php echo $cocccc ?>" value="<?php echo $term->gid ?>"  />
	                           <input  type="hidden" name="jiazai_lei1<?php echo $cocccc ?>" id="jiazai_lei1<?php echo $cocccc ?>" value="<?php echo $term_tag ?>"  />
	                          <input  type="hidden" name="jiazai_page<?php echo $cocccc ?>" id="jiazai_page<?php echo $cocccc ?>" value="1"  />
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
											 html += '<img src="'+json[i].img_thumbs+'" alt="'+json[i].title+'"   >';
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
							//load_page<?php echo $cocccc ?>();
							//$("#jiazai<?php echo $cocccc ?>").hide();
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
     

