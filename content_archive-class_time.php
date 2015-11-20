
<div class="row contact">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <ul class="nav nav-tabs" role="tablist">
          <?php 
			$terms = get_terms('class_time_type', 'orderby=term_id&hide_empty=0&parent=0' );
			$tab_id = 1; 
			$term_taxonomy_id_arr = array();
			if(!empty($terms)){
				foreach ($terms as $k=>$term) 
				{
					$term_taxonomy_id_arr[$k] = $term->term_taxonomy_id;
					$activ_sel = ($k==0) ? 'class="active"' : '';				
				?>
				<li role="presentation" <?php  echo $activ_sel ?>><i></i><a href="#<?php echo $tab_id ?>" aria-controls="<?php echo $tab_id ?>" role="tab" data-toggle="tab">
				  <label aa='<?php echo $term->term_id ?>'><?php echo $term->name ?></label>
				  </a></li>
				 <?php 
					$tab_id ++;
				}
			}
			
			
			$args['post_type'] = 'class_time';
			$args['tax_query'] =  array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'class_time_type',
						'field'    => 'id',
						'terms'    => $term_taxonomy_id_arr,
					),
			);
			$query = new WP_Query( $args );
			
			 ?>
          </ul>
          <div  class="tab-content">
          	<?php 
			if(!empty($query->posts))
			{
					$rs = $query->posts;
					foreach($rs as $rs_k =>$rs_o){
						$term_list = wp_get_post_terms($rs_o->ID, 'my_taxonomy', array("fields" => "all"));
					}
					exit();
					$arr_shu_v = array('上午9:30-11:00','下午3:00-4:30','下午4:30-6:00','晚上6:00-7:30');
					$arr_shu_k = array('shijian1','shijian2','shijian3','shijian4');
					$arr_heng_v = array('周一','周二','周三','周四','周五','周六','周日');
					$arr_heng_k = array('zhou1','zhou2','zhou3','zhou4','zhou5','zhou6','zhou7');
					$rs = $query->posts;
					$tab_id2= 1;
					$real_time_arr = array();
					foreach($rs as $rs_k =>$rs_o){
							$activ_sel333 = ($tab_id2==1) ? 'active' : '';	
							
							foreach($arr_heng_k as $zhou_v)
							{
								$real_time_arr[$rs_o->ID][$zhou_v] = get_post_meta($rs_o->ID,$zhou_v,true);
								
							}
							
							
				
                    
							$tab_id2++;
					}
					print_R($real_time_arr);	
			}
			?>
          
            
            <div class="row tab-pane"  role="tabpanel" id="2">
              <div class="col-lg-12">
              	<table class="table table-bordered">
                  <tr>
                    <td></td>
                    <td>周一</td>
                    <td>周二</td>
                    <td>周三</td>
                    <td>周四</td>
                    <td>周五</td>
                    <td>周六</td>
                    <td>周日</td>
                  </tr>
                  <tr>
                    <td>上午9:30-11:00</td>
                    <td></td>
                    <td class="active"></td>
                    <td></td>
                    <td class="active"></td>
                    <td></td>
                    <td class="active"></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>下午3:00-4:30</td>
                    <td></td>
                    <td class="active"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>4:30-6:00</td>
                    <td></td>
                    <td class="active"></td>
                    <td></td>
                    <td></td>
                    <td class="active"></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>晚上6:00-7:30</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="active"></td>
                    <td></td>
                    <td></td>
                    <td class="active"></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <label class="hint"><i class="blue-lump"></i>代表有课 集体课：90分钟/节</label>
        </div>
      </div>


