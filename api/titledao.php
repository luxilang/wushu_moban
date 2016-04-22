<?php 
header("Content-type: text/html; charset=utf-8");
?>

文章标题导入
<br />
<br />
<br />


<?php 

$droot = str_replace('\\', '/', ((dirname(dirname(__FILE__)))));

date_default_timezone_set ( "Asia/Shanghai" );
		require_once "../wp-config.php";
		require_once "cls_mysql.php";
		$mysql_db = new cls_mysql ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
		$arr = array('类型','武术','少儿散打','成人散打','跆拳道','太极拳','空翻');
if ($_FILES) 
{
	if ($_FILES['userfile']['type'] != 'text/plain')
	{
		echo ('上传文件类型错误必须是txt后缀文件');
	}
	else
	{

		$leixing = $_POST['leixing'];
		$tttt = time();
		$up_rand_file = date('YmdHis').'.txt';
		$uploadfile = $droot.'/api/save_title/'.$up_rand_file;
		
		
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
			$field_values['file_type'] = $leixing;
			$field_values['title_file_path'] = $up_rand_file;
			$field_values['ctime'] = time();
			$mysql_db->autoExecute('wp_title_file', $field_values);
			
		    echo "上传成功！";
		} else {
		    echo "上传失败！";
		}	
	}
	

}
$rs = $mysql_db->getAll('select * from wp_title_file where  is_qi = 0 ');
if (!empty($rs)) {


?>
<table width="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>数据文件名</td>
    <td>类型</td>
    <td>操作</td>
  </tr>
  <?php
  foreach ($rs as $value) {
   ?>
  <tr>
    <td><?php echo $value['title_file_path']?></td>
    <td><?php echo $arr[$value['file_type']] ?></td>
    <td><a href="/api/daoru.php?id=<?php echo $value['id'] ?>">开始导入</a></td>
  </tr>
  <?php 
  }	
  ?>
</table>

<?php 


}
?>


<form enctype="multipart/form-data" action="" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- Name of input element determines name in $_FILES array -->
    上传文件文章标题txt: <input name="userfile" type="file" />
    <select name="leixing"  id="leixing">
      <option   value="0">类型</option>
      <option   value="1">武术</option>
      <option   value="2">少儿散打</option>
      <option   value="3">成人散打</option>
      <option   value="4">跆拳道</option>
      <option   value="5">太极拳</option>
      <option   value="6">空翻</option>
    </select>
    <input type="submit" value="上传" />
</form>
