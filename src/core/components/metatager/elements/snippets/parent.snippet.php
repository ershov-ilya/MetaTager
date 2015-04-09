<?php
/**
 * Snippet: parent
 * Project: MetaTager
 * File:    title.snippet.php
 * Date: 20.05.14, time: 17:30
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

/* READ values
------------------------------------*/
$resource = $modx->getObject('modResource', $config['id']);

$parent = $resource->get('parent');

if(empty($config['field'])) return $parent;
if($parent==0) return '';

$id=$parent;
$field=$config['field'];
$resource = $modx->getObject('modResource', $id);
$value = $resource->get($field);


return $value;
