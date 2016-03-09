<?php require get_template_directory() . '/ajax.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,user-scalable=no">
<?php 
			$fubiaoti ='';
			$post->rs_html_xiangxi = '';
			$post->rs_o = '';
			$post->rs_html_host = '';
			if (strpos($_SERVER['REQUEST_URI'], '?p=')) {

				//加载文章标题
				$title_id = $post->ID;
				$title_type = $post->title_type;
				$sql = "SELECT * FROM wp_article WHERE title_id ='{$title_id}' AND flag = 1 LIMIT 1";
				$rs = $wpdb->get_results($sql);
				$rs_o = $rs[0];
				$file_path = $rs_o->file_path;
				$html_url = 'http://'.$_SERVER['HTTP_HOST'].'/'.$file_path;
				$html =  file_get_contents($html_url); 
				$html = mb_convert_encoding($html, "UTF-8", "GB2312");
				preg_match_all('/<h4.+?>(.*?)<\/h4>/si' ,$html, $r);
				if (!empty($r[1][0])) {
					$fubiaoti = $r[1][0];
				}
	
				$host = str_replace(strrchr($html_url, '/'),'' , $html_url).'/';
				$post->rs_html_xiangxi = $html;
				$post->rs_o  = $rs;
				$post->rs_html_host = $host;
			} 

?>
<title><?php wp_title( ' | ', true, 'right' );  if (!empty($fubiaoti)) {echo ' | '.$fubiaoti.' | ';}  bloginfo('name'); ?></title>
<link href="<?php echo  site_url() ?>/dist/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo  site_url() ?>/dist/css/media-eidt.css" rel="stylesheet" media="screen">
<link href="<?php echo  site_url() ?>/dist/css/css.css" rel="stylesheet" media="screen">
<link href="<?php echo  site_url() ?>/dist/css/css_m.css" rel="stylesheet" media="screen">
<script src="<?php echo  site_url() ?>/dist/js/jQuery-1.11.2.js"></script> 
<script src="<?php echo  site_url() ?>/dist/js/bootstrap.min.js"></script> 
<script>
	$(function(){
		$(window).click(function(){
			$('#navbar').removeClass('in');
		})
	})
</script>
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
				if ($nav_post_type == 'class_fee') $body_css_type = 'class="charge"';	
				
							
				
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
		
	
			if(is_category())
			{
				$nav_post_type = 'category';
				$body_css_type = 'class="courses"';
			}
			if (strpos($_SERVER['REQUEST_URI'], '?p=')) {
				$nav_post_type = 'category';
				$body_css_type = 'class="courses"';
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
				'bbs'=>array('/bbs','论坛'),
				'guanyuwomen'=>array('/?page_id=1','关于我们'),
				'category'=>array('/?cat=1','文章'),
		
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
	      <ul class="nav nav-pills nav-pills-small">
	      <?php 
	      $nav_cf_1 = array(
				'home'=>array('/','首页'),
				'courses'=>array('/?post_type=courses','课程介绍'),
				'lianxiwomen'=>array('/?page_id=3','联系我们')
			);
	      ?>
	        <?php 
		  foreach($nav_cf_1 as $k=>$v)
		  {
				$nav_active = '';
				if(trim($nav_post_type) == trim($k)) $nav_active= 'class="active"';
				
		  ?>
          <li <?php echo  $nav_active ?> ><a href="<?php echo $v[0]?>"><?php echo $v[1] ?></a></li>
          <?php 
		  }
		  ?>
	      
	      </ul>
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
