<?php

$file=scandir(dirname(__FILE__).'/save_temp');
echo "<pre>";
print_R($file);
echo "</pre>";