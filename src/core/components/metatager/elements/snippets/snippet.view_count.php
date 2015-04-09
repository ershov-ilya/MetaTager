<?php
/**
 * Created by PhpStorm.
 * Author:   ershov-ilya
 * GitHub:   https://github.com/ershov-ilya/
 * About me: http://about.me/ershov.ilya (EN)
 * Website:  http://ershov.pw/ (RU)
 * Date: 26.03.2015
 * Time: 17:44
 */

$value = $modx->resource->getTVValue('view_count');
if($value==NULL) return '';

if(isset($scriptProperties['increment'])){
    $value=$value+(int)$scriptProperties['increment'];
    $modx->resource->setTVValue('view_count',$value);
    $modx->resource->set('view_count', null);
}
return $value;