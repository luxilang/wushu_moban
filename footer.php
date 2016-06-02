<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
      <?php 
	      						$rs_school_info = $wpdb->get_results("select * from wp_posts where  post_status = 'publish'  and  post_type = 'school_info'   order by ID desc " );
								if (!empty($rs_school_info)) {
						
									foreach ($rs_school_info as $key => $rs_school_o) {
	      ?>
	        <div class="address">
	          <h3><?php echo $rs_school_o->post_title  ?></h3>
	          <label><span>学院地址：</span><?php echo get_post_meta($rs_school_o->ID,'_school_ad',true);  ?></label>
	          <label><span>联系电话：</span><?php echo get_post_meta($rs_school_o->ID,'_school_phone',true);  ?></label>
	          <label><span>乘车路线：</span><?php echo get_post_meta($rs_school_o->ID,'_school_bus_line',true);  ?></label>
	          	<?php 
				$school_tiebus_line = get_post_meta($rs_school_o->ID,'_school_tiebus_line',true);
				if (!empty($school_tiebus_line)) {
					?>
					<label><span>地铁路线：</span><?php echo  $school_tiebus_line ?></label>
					<?php 
	
				}
				?>
	          
	        </div>
	        <?php 
							}
						}
        ?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
       <!--   <div class="code"> <img src="/dist/img/footer-code.jpg">
          <label>扫描二维码<span>用手机访问本站</span></label>
        </div>-->
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 copyright"> <span>Copyright(c)2010-2015 武术世家 版权所有    京ICP备11008151号京公网安备11010802014853</span> </div>
    </div>
  </div>
</div>

</body>
</html>
<link rel="stylesheet" href="<?php echo  site_url() ?>/lightbox/css/lightbox.css">
<script src="<?php echo  site_url() ?>/lightbox/js/lightbox.js"></script>