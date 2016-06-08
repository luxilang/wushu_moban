	<?php 
	function get_postimg_list($tp,$post_id,$img_tag,$thumbs_cf) {
		global $wpdb;
		$rs_arr = array();
		$sql = "  select * from wp_post_img  where post_id = '{$post_id}' and tp='{$tp}' and img_tag='{$img_tag}' order by id desc   ";
	
		$wp_post_img_rs =  $wpdb->get_results($sql);
		$galleryid_in = array();
		if (!empty($wp_post_img_rs)) {
		
			foreach ($wp_post_img_rs as $value) {
				if (!empty($value->gid)) {
					$galleryid_in[] = $value->gid;
				}
				
			}
			$galleryid_in_str = join(",",$galleryid_in);	
			$sql = "
				SELECT wp_ngg_gallery.name AS dirname,wp_ngg_pictures.* 
				FROM  wp_ngg_pictures 
				LEFT JOIN wp_ngg_gallery ON  wp_ngg_gallery.gid = wp_ngg_pictures.galleryid			
				WHERE  wp_ngg_pictures.galleryid IN ({$galleryid_in_str}) ORDER BY FIELD(wp_ngg_pictures.galleryid, {$galleryid_in_str}) 
			";
			
			$pictures = $wpdb->get_results($sql);
			
			if (!empty($pictures)) {
				foreach ($pictures as $picture) {
					$img_url = "/wp-content/gallery/".$picture->dirname."/".$picture->filename;
					$img_url_r = "/wp-content/gallery/".$picture->dirname."/".$picture->filename;
					//$img_thumbs = "/wp-content/gallery/".$picture->dirname."/thumbs/thumbs_".$picture->filename;
					//$img_thumbs = site_url()."/wp-content/uploads/timthumb.php?src=".site_url().$img_url."&w=274&h=370&q=100&zc=1&ct=1&a=t";
					$img_thumbs = my_thumb_img($img_url,"&w=274&h=370".get_timthumb_cf());
					$rs_arr[]= array(
						'id'=>$picture->pid,
						'title'=>$picture->alttext,
						'img_url'=>$img_url,
						'img_url_r'=>($img_url_r == '') ? $img_url : $img_url_r,
						'img_thumbs'=>$img_thumbs
					);	
				}
			}
			
		}
		
		return 	$rs_arr;
	}
	function xycg($wp_post_img_rs) {
		$html = '';
		if (!empty($wp_post_img_rs)) {
				foreach ($wp_post_img_rs as $wp_post_img_rs_value) {
      			$html .= '<a href="'.$wp_post_img_rs_value['img_url'].'" class="example-image-link" data-lightbox="example-set" data-title="">';
                $html .= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">';

                $html .= '<div class="picList">';
                $html .= '<div class="b-layer" data-toggle="modal" data-target="#Modal"><i class="glyphicon glyphicon-plus"></i></div>';
                $html .= '<img src="'.$wp_post_img_rs_value['img_thumbs'].'"> </div>';

                $html .= '</div>';
				$html .= '</a>';
			}
		}

		return $html;
	}	
	?>
	
																<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													                  <ul class="nav nav-tabs nav-tabs-level2" role="tablist">
													                    <li role="presentation" class="active"><i></i><a href="#5_1" aria-controls="5_1" role="tab" data-toggle="tab">
													                      <label>训练花絮</label>
													                      </a></li>
													                    <li role="presentation"><i></i><a href="#5_2" aria-controls="5_2" role="tab" data-toggle="tab">
													                      <label>比赛集锦</label>
													                      </a></li>
													                    <li role="presentation"><i></i><a href="#5_3" aria-controls="5_3" role="tab" data-toggle="tab">
													                      <label>获奖证书</label>
													                      </a></li>
													                    <li role="presentation"><i></i><a href="#5_4" aria-controls="5_4" role="tab" data-toggle="tab">
													                      <label>学员表演</label>
													                      </a></li>
													                  </ul>
												                  <div class="tab-content"> 
												                  	<div class="row tab-pane active"  role="tabpanel" id="5_1">
												                  	<?php 
												                  			echo  xycg(get_postimg_list('_id_tinymce_xycg',$post_id,'训练花絮',"&w=274&h=370&q=100&zc=1&ct=1&a=t"));
												                  	?>
												                  	</div>
												
												                  	<div class="row tab-pane"  role="tabpanel" id="5_2">
												                  	<?php 
												                  			echo  xycg(get_postimg_list('_id_tinymce_xycg',$post_id,'比赛集锦',"&w=274&h=370&q=100&zc=1&ct=1&a=t"));
												                  	?>
												              
												                  	</div>
												                  	 <div class="row tab-pane"  role="tabpanel" id="5_3">
												                  	
												                  	<?php 
												                  			echo  xycg(get_postimg_list('_id_tinymce_xycg',$post_id,'获奖证书',"&w=274&h=370&q=100&zc=1&ct=1&a=t"));
												                  	?>
												                  			
												                  	</div>
												                  	      <div class="row tab-pane"  role="tabpanel" id="5_4">
												                  	<?php 
												                  			echo  xycg(get_postimg_list('_id_tinymce_xycg',$post_id,'学员表演',"&w=274&h=370&q=100&zc=1&ct=1&a=t"));
												                  	?>
												                  			
												                  	</div>
												
												                  </div>
												                </div>