<?php
function insert($database, $table, $fields, $values) {
	$sql = sprintf ( "INSERT INTO `%s`.`%s`(%s) VALUE ", $database, $table, implode ( ',', $fields ) );
	$nv = count ( $values );
	$nf = count ( $fields );
	for($i = 0; $i < $nv; $i ++) {
		$val = '';
		for($j = 0; $j < $nf; $j ++) {
			$values [$i] [$j] = mysql_real_escape_string ( $values [$i] [$j] );
			$val .= sprintf ( "'%s',", $values [$i] [$j] );
		}
		$sql .= sprintf ( "(%s),", substr ( $val, 0, - 1 ) );
	}
	return substr ( $sql, 0, - 1 );
}

function fetchDir($dir) {
		
		$file_arr = array();
        foreach(glob($dir.'\*') as $file) {
        	
        	if (!is_dir($file)) {
        		 if (strpos($file,'images' ) === false) {
        		 	$file_arr[] = $file;
        		 }
        	}
            if(is_dir($file)) {
            
               $file_arr[] = fetchDir($file);
            }
        }
        return $file_arr;
} 


function du_log( $logthis ){
	file_put_contents('logfile.log', date("Y-m-d H:i:s"). " " . $logthis.PHP_EOL, FILE_APPEND | LOCK_EX);
}
function zip_extract($file, $extractPath) {
	
	$zip = new ZipArchive ();
	$res = $zip->open ( $file );
	if ($res === TRUE) {
		$zip->extractTo ( $extractPath );
		$zip->close ();
		return TRUE;
	} else {
		return FALSE;
	}

}