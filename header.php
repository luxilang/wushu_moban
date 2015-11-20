<?php 
if (!empty($_POST['ajax_type'])) 
{
		if ($_POST['ajax_type']  == 'post') {
								
				 $jiazai_tp = strip_tags($_POST['jiazai_tp']);
			 	 $lei = strip_tags($_POST['jiazai_lei']);
				 $lei1 = strip_tags($_POST['jiazai_lei1']);
				 $page = strip_tags($_POST['jiazai_page']);
				 $page_number = 3;
				 if ($jiazai_tp == 'students' || $jiazai_tp == 'teachers') 
				 {
				 	$page_number = 3;
				 }
				$args['posts_per_page'] = $page_number;
				
				if (empty($page)) {
					$position = 0; 
					$jiazai_page = 1;
				}else{
					$position = ($page_number * $page); 
					$jiazai_page = $page+1; 
				}
				
				$args['offset'] = $position;
				$args['post_type'] = $jiazai_tp;
				if (!empty($lei) && !empty($lei1)) {

							if ($jiazai_tp == 'students') {
								$taxonomy_type_arr = array('students_type','students_type1');
							}
					
					 		$args['tax_query']['relation'] = 'AND';

							if (!empty($lei)) {
								array_push($args['tax_query'], array(
											'taxonomy' => $taxonomy_type_arr[0],
											'field'    => 'slug',
											'terms'    => array( "$lei"),
								));
								
							
							}
							
							if (!empty($lei1)) {
									array_push($args['tax_query'], array(
											'taxonomy' => $taxonomy_type_arr[1],
											'field'    => 'slug',
											'terms'    => array( "$lei1"),
								));
							
							}
		
				}else{
					if (!empty($lei)) {
						if ($jiazai_tp == 'teachers') {
								$taxonomy_type = 'teachers_type';
						}
						
						$args['tax_query'] =  array(
						        'relation' => 'AND',
						        array(
						            'taxonomy' => $taxonomy_type,
						            'field'    => 'slug',
						            'terms'    => array( "$lei"),
						        ),
						);
					}
		 		}	
	
				
				$query = new WP_Query( $args );
				
				//print_R($query);
				$rs_arr = array();
				$rs_arr['page'] = $jiazai_page;

				$rs_arr['rs'] = array();
				if (!empty($query->posts)) {
						$rs = $query->posts;	
						foreach ($rs as $rs_o) {
							
								if($jiazai_tp == 'students')
								{
								
									$img_url = get_post_meta($rs_o->ID,'_id_upload_students',true);
									$rs_arr['rs'][]= array(
										'id'=>$rs_o->ID,
										'title'=>$rs_o->post_title,
										'img_url'=>$img_url,
										'permalink'=>get_permalink($rs_o->ID),
									);	
								}elseif ($jiazai_tp == 'teachers'){
									$img_url = get_post_meta($rs_o->ID,'_id_upload_teachers',true);
									$rs_arr['rs'][]= array(
										'title'=>$rs_o->post_title,
										//'content'=>$rs_o->post_content,
										'img_url'=>$img_url,
										'permalink'=>get_permalink($rs_o->ID),
										'yddj'=>get_post_meta($rs_o->ID,'_teachers_yddj',true),
										'sewsjljy'=>get_post_meta($rs_o->ID,'_teachers_sewsjljy',true),
										'jxfg'=> get_post_meta($rs_o->ID,'_teachers_jxfg',true),
									);
								}						
						}
				
				}
				wp_reset_postdata();
		
				echo   json_encode($rs_arr,true);
				exit();
		}elseif ($_POST['ajax_type']  == 'hehe'){
			
			
			
		}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
<link href="<?php echo  site_url() ?>/dist/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo  site_url() ?>/dist/css/media-eidt.css" rel="stylesheet" media="screen">
<link href="<?php echo  site_url() ?>/dist/css/css.css" rel="stylesheet" media="screen">
<link href="<?php echo  site_url() ?>/dist/css/css_m.css" rel="stylesheet" media="screen">
<script src="<?php echo  site_url() ?>/dist/js/jQuery-1.11.2.js"></script> 
<script src="<?php echo  site_url() ?>/dist/js/bootstrap.min.js"></script> 
</head>
<?php 	

		$body_css_type = '';
			if(is_home())
			{
				$nav_post_type = 'home';
				$body_css_type = 'class="index"';
			}else if(is_archive()){
				$nav_post_type = get_post_type();
				//更换css
				if ($nav_post_type == 'class_activities') $body_css_type = 'class="discount"';
				if ($nav_post_type == 'class_env') $body_css_type = 'class="facility"';	
				if ($nav_post_type == 'teachers') $body_css_type = 'class="teachers"';
				if ($nav_post_type == 'courses') $body_css_type = 'class="courses"';
				if ($nav_post_type == 'students') $body_css_type = 'class="student"';		
				if ($nav_post_type == 'class_time') $body_css_type = 'class="schooltime"';		
							
				
			}else if(is_single()){
				$nav_post_type = get_post_type();
				if ($nav_post_type == 'courses') $body_css_type = 'class="course-view"';
				if ($nav_post_type == 'teachers') $body_css_type = 'class="teachers-view"';
				
			}
			else if(is_page(3))
			{
				$nav_post_type = 'lianxiwomen';
				$body_css_type = 'class="contact"';
				
			}
			else if(is_page(1))
			{
				$nav_post_type = 'guanyuwomen';
				$body_css_type = 'class="about"';
			}else{
				$nav_post_type = 'bbs';
			}
?>
<body <?php echo $body_css_type ?>>
<div class="container head">
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 logo"> <img src="<?php echo  site_url() ?>/dist/img/logo.png"> </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
      <div class="phone">
        <label>报名热线：18911639063</label>
        <img src="<?php echo  site_url() ?>/dist/img/xws.png"> </div>
    </div>
  </div>
</div>

<div class="caidan">
  <div class="container">
    <div class="row">
        <?php 
	
			//print_R($nav_post_type);
			$nav_cf = array(
				'home'=>array('/','首页'),
				'courses'=>array('/?post_type=courses','课程介绍'),
				'students'=>array('/?post_type=students','学员信息'),
				'teachers'=>array('/?post_type=teachers','教练信息'),
				'lianxiwomen'=>array('/?page_id=3','联系我们'),
				'bbs'=>array('bbs','论坛'),
				'guanyuwomen'=>array('/?page_id=1','关于我们'),
		
			);
			

		?>
    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs">
        <ul class="nav nav-pills">
          <?php 
		  foreach($nav_cf as $k=>$v)
		  {
				$nav_active = '';
				if(trim($nav_post_type) == trim($k)) $nav_active= 'class="active"';
				
		  ?>
          <li <?php echo  $nav_active ?> ><a href="<?php echo $v[0]?>"><?php echo $v[1] ?></a></li>
          <?php 
		  }
		  ?>
        </ul>
      </div>
      <div class="hidden-lg hidden-md hidden-sm">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
        </button>
        <div id="navbar" class="navbar-collapse collapse" aria-expanded="true">
          <ul class="nav navbar-nav">
          <?php 
		  foreach($nav_cf as $k=>$v)
		  {
				$nav_active = '';
				if(trim($nav_post_type) == trim($k)) $nav_active= 'class="active"';
				
		  ?>
          <li <?php echo  $nav_active ?> ><a href="<?php echo $v[0]?>"><?php echo $v[1] ?></a></li>
          <?php 
		  }
		  ?>
          </ul>
        </div>
      </div>
      
    </div>
  </div>
</div>


<div class="banner">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <img src="<?php echo site_url(); ?>/dist/img/banner.png"> </div>
    </div>
  </div>
</div>
