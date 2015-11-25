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
			
			$all_ids = array();
			foreach ($terms as $term) 
			{		
					$lei_url = ''; if (!empty($term['slug']))  $lei_url = "&lei={$term['slug']}";
					$activ_sel = ($lei== trim($term['slug'])) ? 'class="active"': '';	
					
					$leiurl = ''; if (!empty($lei1)) $leiurl =  "&lei1={$lei1}";
					if(!empty($term['term_id']))
					{
						$all_ids[] = $term['term_id'];
					}
				 ?>
				  <li role="presentation" <?php echo $activ_sel ?>><i></i><a href="<?php echo $url_bs.$lei_url.$leiurl ?>"  >
				 <label><?php echo $term['name'] ?></label>
				 </a></li>

				 <?php 
				 $tab_nav ++;
				
			}
			?>

          </ul>
          <div class="tab-content"> 
            <!--1-->
            <div class="row tab-pane active"  role="tabpanel"  >
          			<div id="neirong"></div>
         			 <input  type="hidden" name="jiazai_tp" id="jiazai_tp" value="class_fee"  />
                    <input  type="hidden" name="jiazai_lei" id="jiazai_lei" value="<?php echo $lei ?>"  />
                      <input  type="hidden" name="jiazai_page" id="jiazai_page" value="0"  />
          
               		 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="jiazai">
                        <div class="row">
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                            <button type="button" onclick="load_page();" class="btn btn-lg btn-block btn-blue">加载更多 <i class="glyphicon glyphicon-save"></i></button>
                          </div>
                        </div>
                      </div>
            </div>
          </div>
<script>
function load_page(){
	var jiazai_tp  = $("#jiazai_tp").val();
	var jiazai_lei  = $("#jiazai_lei").val();
	
	var jiazai_page  = $("#jiazai_page").val();
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
				$("#jiazai").hide();
			}
			else{
				
				if(json.length <=2)
				{
					$("#jiazai").hide();
				}
				var html ='';
				
				for(i=0;i<json.length;i++)
				{
				  html += '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
                  html += '<div class="blue-box">';
           
                  html += json[i].content;
				  html += ' <button type="button" class="btn btn-block">立刻购买</button>';
				  html += '</div>';
				  html += '</div>';

				}
				//alert(html);
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
});
</script>
          
          <!---->
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3 class="title">《私教1对1》课程套餐</h3>
            <ul class="nav nav-tabs" role="tablist">
            <?php 
foreach ($terms1 as $term1) 
{
				
		$lei_url1 = ''; if (!empty($term1->slug))  $lei_url1 = "&lei1={$term1->slug}";
		$activ_sel1 = ($lei1== trim($term1->slug)) ? 'class="active"' : '';
		$leiurl = ''; if (!empty($lei)) $leiurl =  "&lei={$lei}";			
	 ?>
            <li role="presentation" <?php echo  $activ_sel1 ?>><i></i><a href="<?php echo $url_bs.$lei_url1.$leiurl ?>" >
            <label> <?php echo $term1->name ?></label>
            </a></li>
	 <?php 
	
}
?>
            </ul>
            <div class="tab-content"> 
            
            
              <div class="row tab-pane active"  role="tabpanel" >
              	<?php 
				
				
				$args['post_type'] = 'class_fee';
			if (!empty($lei1)) {
				
				$args['tax_query'] =  array(
				        'relation' => 'AND',
				        array(
				            'taxonomy' => 'class_fee_type_1v1',
				            'field'    => 'slug',
				            'terms'    => array( "$lei1"),
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
                    <button type="button" class="btn btn-block">立刻购买</button>
                  </div>
                </div>
                		<?php 
							
                                }
                        }
                        wp_reset_postdata();
            ?>
              </div>
	
              <!--tab end--> 
            </div>
            <!----> 
          </div>
        </div>
      </div>
