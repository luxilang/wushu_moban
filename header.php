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
</head>
<body 
<?php 	

		$body_css_type = '';
			if(is_home())
			{
				$nav_post_type = 'home';
				$body_css_type = 'class="index"';
			}else if(is_archive()){
				$nav_post_type = get_post_type();
				//优惠互动时候
				if ($nav_post_type == 'class_activities') {
					$body_css_type = 'class="discount"';
				}
				
				
			}else if(is_single()){
				$nav_post_type = get_post_type();
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

<?php echo $body_css_type ?>
>
<div class="container head">
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 logo"> <img src="<?php echo  site_url() ?>/dist/img/logo.png"> </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
      <div class="phone">
        <label>报名热线：18911639063</label>
        <img src="<?php echo  site_url() ?>/dist/img/xws.png"> </div>
    </div>
  </div>
</div>

<div class="caidan">
  <div class="container">
    <div class="row">
      <ul class="nav nav-pills">
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


<div class="banner">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12"> <img src="<?php echo site_url(); ?>/dist/img/banner.png"> </div>
    </div>
  </div>
</div>
