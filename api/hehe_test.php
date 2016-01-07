<?php
$fff = iconv('utf-8', 'GB2312//IGNORE', "D:/projects/wushushijia/拆分的文章/武术基础_12057379.zip");
function curlrequest($url,$data,$method='post'){

    $ch = curl_init(); //初始化CURL句柄 
    curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); //设置请求方式
     
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-HTTP-Method-Override: $method"));//设置HTTP头信息
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//设置提交的字符串
    $document = curl_exec($ch);//执行预定义的CURL 
    //if(!curl_errno($ch)){ 
      //$info = curl_getinfo($ch); 
      //echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url']; 
   // } else { 
     // echo 'Curl error: ' . curl_error($ch); 
   // }
    curl_close($ch);
     
    return $document;
}
//
//$url = 'http://127.0.0.1:89/api/hehe.php';
$url = 'http://123.57.75.215/wushu/api/shangchuan.php';
$data = file_get_contents($fff);
$return = curlrequest($url, $data, 'put');
 
print_R($return);