<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

function debug($str) {
	echo '<pre>';
	var_dump($str);
	echo '</pre>';
	exit;
}

function myHash ($var) {
	$salt1 = 'ABC';
	$salt2 = 'CBA';
	$var = crypt(md5($var.$salt1), $salt2);
	return $var;
}