<?php
/**
 * Snippet: title
 * Project: MetaTager
 * File:    title.snippet.php
 * Date: 02.12.13, time: 14:37
 * Author:  ILYA ERSHOV  
 * http://about.me/ershov.ilya
 * GitHub:  https://github.com/ershov-ilya
 * Edited in PhpStorm.
 */


/* CONFIG
------------------------------------*/
$defconfig = array(
	'id' => $modx->resource->get('id'),
);

$config = array_merge($defconfig, $scriptProperties);

/* READ values
------------------------------------*/
$resource = $modx->getObject('modResource', $config['id']);

// Page values
$arr['pagetitle'] = $resource->get('pagetitle');
$arr['longtitle'] = $resource->get('longtitle');

$output = '';
if(!empty($arr['longtitle'])) $output = $arr['longtitle'];
else  $output = $arr['pagetitle'];

return $output;
