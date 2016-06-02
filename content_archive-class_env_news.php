<?php 

	global $wpdb;
	$wp_ngg_album = $wpdb->get_row("SELECT * FROM wp_ngg_album  WHERE name = '上课环境' ");
	
	$gid_ls = unserialize($wp_ngg_album->sortorder);
	$gid_ls_str = join(",",$gid_ls);	
	
	$wp_ngg_gallery = $wpdb->get_results("SELECT * FROM wp_ngg_gallery WHERE  gid  IN($gid_ls_str)  order by field(gid,$gid_ls_str)  ");

	$curr_gallery = $wp_ngg_gallery[0];

	$curr_gid = $curr_gallery->gid;
	//$tag_items = get_terms('ngg_tag', 'ignore_empty=true' );   


?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <ul class="nav nav-tabs" role="tablist">
                 <?php


$terms_i = 1;
foreach ($wp_ngg_gallery as $term) 
{
				 $activ_sel = ($terms_i == 1) ? 'class="active"' : '';			
	 ?>
            <li role="presentation"  <?php echo  $activ_sel ?> ><i></i><a href="#<?php echo $terms_i ?>" aria-controls="<?php echo $terms_i ?>" role="tab" data-toggle="tab" >
              <label> <?php echo $term->title  ?></label>
              </a></li>

              	 <?php 
	$terms_i ++;
}
?>
          </ul>
          <div class="tab-content">
          	<?php 
          	$terms_i = 1;
          	foreach ($wp_ngg_gallery as $term) 
			{
				 $activ_sel = ($terms_i == 1) ? 'active' : '';			
				 ?>
        
            <div class="row tab-pane <?php echo $activ_sel ?>"  role="tabpanel"  id="<?php echo $terms_i ?>">
               	 		<div id="neirong<?php echo $terms_i ?>">
               	 		<?php 

				 	$curr_gid = $term->gid;
				 	$sql = "
					SELECT wp_ngg_gallery.name AS dirname,wp_ngg_pictures.* FROM  wp_ngg_pictures 
					LEFT JOIN wp_ngg_gallery ON  wp_ngg_gallery.gid = wp_ngg_pictures.galleryid
					WHERE  wp_ngg_pictures.galleryid = '{$curr_gid}'  limit 0,3
				 	";

				 	$pictures = $wpdb->get_results($sql);
				 	$rs_arr = array();
					$rs_arr['page'] = $jiazai_page;
					$rs_arr['rs'] = array();
					
				 	foreach ($pictures as $picture) {
						$img_url = "/wp-content/gallery/".$picture->dirname."/".$picture->filename;
						$img_url_r = "/wp-content/gallery/".$picture->dirname."/".$picture->filename;
						//$img_thumbs = "/wp-content/gallery/".$picture->dirname."/thumbs/thumbs_".$picture->filename;
						$img_thumbs = site_url()."/wp-content/uploads/timthumb.php?src=".site_url().$img_url."&w=274&h=220".get_timthumb_cf();
						$title = $picture->alttext;
						
						?>
								<a href="<?php echo $img_url  ?>" class="example-image-link" data-lightbox="example-set" data-title="">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="picList">
									<div class="b-layer"><i class="glyphicon glyphicon-plus"></i></div>
									<img src="<?php echo $img_thumbs  ?>" alt="<?php echo $title  ?>" >
									</div>
									</div>
								</a>
						<?php
						
				 	}
               	 	?>
               	 		
               	 		
               	 		</div>
                         <input  type="hidden" name="jiazai_tp<?php echo $terms_i ?>" id="jiazai_tp<?php echo $terms_i ?>" value="class_env"  />
                    	<input  type="hidden" name="jiazai_lei<?php echo $terms_i ?>" id="jiazai_lei<?php echo $terms_i ?>" value="<?php echo $term->gid ?>"  />
                      	<input  type="hidden" name="jiazai_page<?php echo $terms_i ?>" id="jiazai_page<?php echo $terms_i ?>" value="1"  />
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
									 html += '<img src="'+json[i].img_thumbs+'" alt="'+json[i].title+'" >';
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
				
						//load_page<?php echo $terms_i ?>();
						//$("#jiazai<?php echo $terms_i ?>").hide();	
				});
				</script>	
			<?php 
				$terms_i ++;
			}
			?>
          </div>
        </div>
      </div>

			
						