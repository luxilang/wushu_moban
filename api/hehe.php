<?php
$putdata = fopen("php://input", "r");
$fp = fopen("111.zip", "w");

/* Read the data 1 KB at a time
   and write to the file */
while ($data = fread($putdata, 1024))
  fwrite($fp, $data);

/* Close the streams */
fclose($fp);
fclose($putdata);
echo 1;