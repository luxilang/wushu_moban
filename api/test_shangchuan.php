<?php
/**
 * 测试发包程序
 */
//$uploaddir = getcwd();
//$file = $uploaddir."/9N0CB31K28JU0007.jpg"; //这里非常重要！一定要绝对地址才行，所以使用这个拼接成了绝对地址
$file = iconv('utf-8', 'GB2312//IGNORE', "D:/projects/wushushijia/分割程序base_64/zuTK9bP1vdc=.zip");

// Create a cURL handle
//$ch = curl_init('http://123.57.75.215/wushu/api/shangchuan.php');
$ch = curl_init('http://127.0.0.1:89/api/shangchuan.php');
//$ch = curl_init('http://www.sjz360.net/api/shangchuan.php');
// Create a CURLFile object
if (!function_exists('curl_file_create')) {
    function curl_file_create($filename, $mimetype = '', $postname = '') {
        return "@$filename;filename="
            . ($postname ?: basename($filename))
            . ($mimetype ? ";type=$mimetype" : '');
    }
}

$cfile = curl_file_create($file);


// Assign POST data
$data = array('fff' => $cfile);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_INFILESIZE,filesize($file)); //这句非常重要，告诉远程服务器，文件大小，查到的是前辈的文章http://blog.csdn.net/cyuyan112233/article/details/21015351

// Execute the handle
curl_exec($ch);


exit();
//echo file_get_contents($url);
//exit();
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

$url = 'http://www.sjz360.net/api/shangchuan.php';
$data = file_get_contents($fff);
$return = curlrequest($url, $data, 'put');
 
print_R($return);




?>