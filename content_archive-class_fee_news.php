<?php
$terms = get_terms('class_fee_type', 'orderby=name&hide_empty=0&parent=0' );
$terms1 = get_terms('class_fee_type_1v1', 'orderby=name&hide_empty=0&parent=0' );    
if (empty($terms[0]))  die('error 0');
if (empty($terms1[0]))  die('error 0');
$terms_one = $terms[0];
$terms_one1 = $terms1[0];
$lei = !empty($_GET['lei']) ?  strip_tags($_GET['lei']) : 'tao0'; 
$lei1 = !empty($_GET['lei1']) ?  strip_tags($_GET['lei1']) : $terms_one1->slug; 
$url_bs = '?post_type=class_fee';

?>
<div class="row content">
        <?php 
			echo $content = get_post('7')->post_content;   
    	?>
        <!---->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <h3 class="title">《集体课程》套餐</h3>
          <ul class="nav nav-tabs" role="tablist">
          <?php 
		    $tab_nav = 1;
			function objectToArray($e){
				$e=(array)$e;
				foreach($e as $k=>$v){
					if( gettype($v)=='resource' ) return;
					if( gettype($v)=='object' || gettype($v)=='array' )
						$e[$k]=(array)objectToArray($v);
				}
				return $e;
			}
			
		
			$terms = objectToArray($terms);
			$all_arr = array(
				'name'=>'全部课程',
				'slug'=>'tao0'
			);
			array_unshift($terms,$all_arr);
			
			//不限次数排在后面！
			$no_limit = $terms[1];
			unset($terms[1]);
			array_push($terms, $no_limit);
			sort($terms);
			
			
			$all_ids = array();
			
			$terms_i = 1;
			foreach ($terms as $term) 
			{		
					$lei_url = ''; if (!empty($term['slug']))  $lei_url = "&lei={$term['slug']}";
					$activ_sel = ($terms_i == 1) ? 'class="active"': '';	
					
					$leiurl = ''; if (!empty($lei1)) $leiurl =  "&lei1={$lei1}";
					if(!empty($term['term_id']))
					{
						$all_ids[] = $term['term_id'];
					}
				 ?>
				  <li role="presentation" <?php echo $activ_sel ?>><i></i>
				  
				  <a href="#<?php echo $terms_i ?>" aria-controls="<?php echo $terms_i ?>" role="tab" data-toggle="tab">
	
				 <label><?php echo $term['name'] ?></label>
				 </a></li>

				 <?php 
				 $tab_nav ++;
				$terms_i ++;
			}
			?>

          </ul>
          <div class="tab-content"> 
           	<?php 
             $terms_i = 1;
              
           	foreach ($terms as $term) 
           	{
           		$activ_sel1 = ($terms_i == 1) ? 'active': '';	
           	?>
            <div class="row tab-pane <?php echo $activ_sel1 ?>"  role="tabpanel"  id="<?php echo $terms_i ?>" >
          			<div id="neirong<?php echo $terms_i ?>">
          				<?php 
          				
          			
					$args['posts_per_page'] = 4;
					$args['offset'] = 0;
					$args['post_type'] = 'class_fee';
					$lei = $term['slug'];
			
				
					if (!empty($lei)) {
						if($lei == 'tao0'){
										
		
								
							$terms_tao = get_terms('class_fee_type', 'orderby=name&hide_empty=0&parent=0' );
							
							$terms_tao = objectToArray($terms_tao);
							
							$all_ids = array();
							foreach ($terms_tao as $term_tao) 
							{		
									if(!empty($term_tao['term_id']))
									{
										$all_ids[] = $term_tao['term_id'];
									}
							}
							
							
							
							
							$args['tax_query'] =  array(
									'relation' => 'AND',
									array(
										'taxonomy' => 'class_fee_type',
										'field'    => 'id',
										'terms'    => $all_ids,
									),
							);
						}else{
							$args['tax_query'] =  array(
									'relation' => 'AND',
									array(
										'taxonomy' => 'class_fee_type',
										'field'    => 'slug',
										'terms'    => array( "$lei"),
									),
							);
						}	
		
					}
					
					
				
					$query = new WP_Query( $args );

					if (!empty($query->posts)) {
						
							$rs = $query->posts;
							
							foreach ($rs as $rs_o) {
				
									?>
									
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			                  <div class="blue-box">
				           		<?php echo $rs_o->post_content ?>
							  <button  data-toggle="modal" data-target="#yyModal"   type="button" class="btn btn-block">免费预约体验</button>
							  </div>
							  </div>
									<?php	
										
							}
					}
					wp_reset_postdata();
		 
	
          				?>
					 		
          			</div>
         			 <input  type="hidden" name="jiazai_tp<?php echo $terms_i ?>" id="jiazai_tp<?php echo $terms_i ?>" value="class_fee"  />
                    <input  type="hidden" name="jiazai_lei<?php echo $terms_i ?>" id="jiazai_lei<?php echo $terms_i ?>" value="<?php echo $term['slug'] ?>"  />
                      <input  type="hidden" name="jiazai_page<?php echo $terms_i ?>" id="jiazai_page<?php echo $terms_i ?>" value="1"  />
          
               		 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="jiazai<?php echo $terms_i ?>">
                        <div class="row">
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                            <button type="button" onclick="load_page<?php echo $terms_i ?>();" class="btn btn-lg btn-block btn-blue">加载更多 <i class="glyphicon glyphicon-save"></i></button>
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
					'/?post_type=class_fee',
					{
						'ajax_type':'post',
						'jiazai_tp':jiazai_tp,
						'jiazai_lei':jiazai_lei,
					
						'jiazai_page':jiazai_page
					},
					function(data){
						var json = data.rs;
						//alert(data.rs);	alert(json.length);
						if(json.length == 0)
						{
							$("#jiazai<?php echo $terms_i ?>").hide();
						}
						else{
							
							if(json.length <=2)
							{
								$("#jiazai<?php echo $terms_i ?>").hide();
							}
							var html ='';
							
							for(i=0;i<json.length;i++)
							{
							  html += '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
			                  html += '<div class="blue-box">';
			           
			                  html += json[i].content;
							  html += ' <button  data-toggle="modal" data-target="#yyModal"   type="button" class="btn btn-block">免费预约体验</button>';
							  html += '</div>';
							  html += '</div>';
			
							}
							//alert(html);
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
			});
			</script>
            <?php 
            	$terms_i ++;
            }
            ?>
          </div>

          
          <!---->
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3 class="title">《私教1对1》课程套餐</h3>
            <ul class="nav nav-tabs" role="tablist">
            <?php 
 $terms1_i = 1;
foreach ($terms1 as $term1) 
{
		$activ_sel1 = ($terms1_i == 1) ? 'class="active"' : '';
				
	 ?>
            <li role="presentation" <?php echo  $activ_sel1 ?>><i></i>
             <a href="#<?php echo $terms1_i ?>" aria-controls="<?php echo $terms1_i ?>" role="tab" data-toggle="tab">
           
            <label> <?php echo $term1->name ?></label>
            </a></li>
	 <?php 
	$terms1_i ++;
}
?>
            </ul>
            <div class="tab-content"> 
            
            <?php 
            $terms1_i = 1;
            foreach ($terms1 as $term1) 
            {
            	$activ_sel1 = ($terms1_i == 1) ? 'active' : '';
            ?>
              <div class="row tab-pane <?php echo $activ_sel1 ?>"  role="tabpanel" id = "<?php echo $terms1_i ?>">
              	<?php 
				
				
				$args['post_type'] = 'class_fee';
			if (!empty($lei1)) {
				
				$args['tax_query'] =  array(
				        'relation' => 'AND',
				        array(
				            'taxonomy' => 'class_fee_type_1v1',
				            'field'    => 'slug',
				            'terms'    => array( "$term1->slug"),
				        ),
				);
			}
			
			
	
			$query = new WP_Query( $args );
			
			if (!empty($query->posts)) {
				
					$rs = $query->posts;
					foreach ($rs as $rs_o) {
				?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <div class="blue-box">
 						  <?php  echo $rs_o->post_content ;?>
                    <button  data-toggle="modal" data-target="#yyModal"  type="button" class="btn btn-block">免费预约体验</button>
                  </div>
                </div>
                		<?php 
							
                                }
                        }
                        wp_reset_postdata();
            ?>
              </div>
			<?php 
				$terms1_i ++;
			}
			?>
              <!--tab end--> 
            </div>
            <!----> 
          </div>
        </div>
      </div>
      <?php include_once 'modal.php';  ?>
