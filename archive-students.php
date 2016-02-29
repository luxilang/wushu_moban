<?php
/*
Template Name: 学员信息模板  
*/ 
/********
if (isset($_GET['frame'])  && $_GET['frame'] == 1) {
require get_template_directory() . '/ajax.php';
	?>
<link href="<?php echo  site_url() ?>/dist/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo  site_url() ?>/dist/css/media-eidt.css" rel="stylesheet" media="screen">
<link href="<?php echo  site_url() ?>/dist/css/css.css" rel="stylesheet" media="screen">
<link href="<?php echo  site_url() ?>/dist/css/css_m.css" rel="stylesheet" media="screen">
<script src="<?php echo  site_url() ?>/dist/js/jQuery-1.11.2.js"></script> 
<script src="<?php echo  site_url() ?>/dist/js/bootstrap.min.js"></script> 

<body class="student" >
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 page-right" style="width: 100%;margin-top: 0px;">
	<?php require 'content_archive-students_frame.php'  ?>
	</div>
	</body>
	<link rel="stylesheet" href="<?php echo  site_url() ?>/lightbox/css/lightbox.css">
	<script src="<?php echo  site_url() ?>/lightbox/js/lightbox.js"></script>
<?php 
}else{
	
}*/
echo_layout('content_archive-students_news.php');

?>
