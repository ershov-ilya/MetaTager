<?php
/**
 * Snippet: GET
 * Project: MetaTager
 * File:    get.php
 * Date: 16.04.14, time: 08:40
 * Author:  ILYA ERSHOV  
 * http://about.me/ershov.ilya
 * GitHub:  https://github.com/ershov-ilya
 * Edited in PhpStorm.
 */


/* CONFIG
------------------------------------*/
$defconfig = array(
	'id' => $modx->resource->get('id')
);

$config = array_merge($defconfig, $scriptProperties);

if(strtolower($config['method'])=='post') $str=$_POST[$config['name']];
elseif(strtolower($config['method'])=='request') $str=$_REQUEST[$config['name']];
else $str=$_GET[$config['name']];

return $str;
