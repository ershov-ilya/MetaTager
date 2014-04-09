<?php
/**
 * Snippet: parent
 * Project: MetaTager
 * File:    title.php
 * Date: 09.04.14, time: 14:53
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

return $parent;