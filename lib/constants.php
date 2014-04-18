<?php
// define ("WEBROOT",'http://'.$_SERVER['SERVER_NAME'].'/PPE-GSB/');
// var_dump(WEBROOT);



define('WWW_ROOT', dirname(dirname(__FILE__)));

$directory = basename(WWW_ROOT);
$url = explode($directory, $_SERVER['REQUEST_URI']);

if (count($url) == 1) {
	define('WEBRROT' . '/');
}
else{
	define('WEBROOT', $url[0] . 'PPE-GSB/');
}

