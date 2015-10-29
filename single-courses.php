<?php


$post_id = $post->ID; //首选需要获取文章id

print_R($post_id);
$img_url = get_post_meta($post_id,'_id_upload',true); //_id_upload即配置数据中的id值，获取的值实际为图片url地址
//输出<img>标签
?>
<img  src="<?php echo $img_url ?>" />