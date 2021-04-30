<?php
session_start();
function debug($arr){
	echo '<pre>'.print_r($arr,1).'</pre>';
}
use components\App;
$app = App::getInstance($maket_temp = 'main_1',$maket_header='header_1');