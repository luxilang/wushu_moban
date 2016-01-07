<?php
$title_id = $post->ID;
$title_type = $post->title_type;
$sql = "SELECT * FROM wp_article WHERE title_id ='{$title_id}' AND flag = 1 LIMIT 1";
$rs = $wpdb->get_results($sql);
if (!empty($rs[0]))  echo  get_bendi_wenzhang($rs);;