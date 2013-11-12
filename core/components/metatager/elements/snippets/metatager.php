<?php
/**
 * Project: MetaTager
 * File:    metatager.php
 * Date: 12.11.13, time: 13:16
 * Author:  MrAgr3ssive
 * GitHub:  http://github.com/MrAgr3ssive
 * Edited in PhpStorm.
 */

/* @var modX $modx */
/* @var modResource $resource */
/*
<base href="[[++site_url]]"/>
<link rel="canonical" href="[[~[[*id]]? &scheme=`full`]]" />
<meta http-equiv="content-language" content="[[++cultureKey]]" />
<link rel="shortcut icon" href="/favicon.ico" />

<title>[[*specific_title:ne=``:then=`[[*specific_title]]`:else=`[[*pagetitle]] - [[++site_name]]` ]]</title>
[[*keywords:ne=``:then=`<meta name="keywords" content="[[*keywords]]"/>`:else=`<meta name="keywords" content="[[$title]]"/>`]]
[[*description:ne=``:then=`<meta name="description" content="[[*description]]"/>`:else=`<meta name="description" content="[[$introtext]]"/>`]]
 */

/* CONFIG
------------------------------------*/
$defconfig = array(
	'id' => $modx->resource->get('id'),
	'context' => $modx->context->key,
	'keywords' => "",
	'kwTVname' => "keywords", // keywords stored in TV
	'favicon_path' => "/favicon.ico",
	'spec_titleTVname' => "specific_title",
	'scheme' => "full", // syntax of modX.makeUrl
	'minify' => '0',
	'debug' => '0'
);
$config = array_merge($defconfig, $scriptProperties);
$n="\n";
if($config['minify']) $n='';

/* READ values
------------------------------------*/
$resource = $modx->getObject('modResource', $config['id']);

// System options
$arr['site_url'] = $modx->getOption('site_url');
$arr['site_name'] = $modx->getOption('site_name');
$arr['cultureKey'] = $modx->getOption('cultureKey');

// Page values
$arr['pagetitle'] = $resource->get('pagetitle');
$arr['longtitle'] = $resource->get('longtitle');
$arr['introtext'] = $resource->get('introtext');
$arr['description'] = $resource->get('description');

// Keywords
if(!empty($config['keywords'])) $arr['keywords'] = $config['keywords'];
else $arr['keywords'] = $resource->getTVValue($config['kwTVname']);
// TVs
$arr['specific_title'] = $resource->getTVValue($config['spec_titleTVname']);

// Snippets return
$arr['full_url'] = $modx->makeUrl($config['id'], $config['context'], '', $config['scheme']);

if($config['debug'])
{
	print "<pre>";
	print "Config:\n";
	print_r($config);
	print "Calculated:\n";
	print_r($arr);
	print "</pre>";
}

/* make OUTPUT
------------------------------------*/
$output='';
$output.='<base href="'.$arr['site_url'].'"/>'.$n;
$output.='<link rel="canonical" href="'.$arr['full_url'].'" />'.$n;
$output.='<meta http-equiv="content-language" content="'.$arr['cultureKey'].'" />'.$n;
$output.='<link rel="shortcut icon" href="'.$config['favicon_path'].'" />'.$n;

// Title
// Logic: "specific_title (TV)" or "longtitle - sitename" or "pagetitle - sitename"
$title = $arr['pagetitle'];
if(!empty($arr['longtitle'])) $title = $arr['longtitle'];
if(!empty($arr['specific_title'])) $title = $arr['specific_title'];
$output.='<title>'.$title.'</title>'.$n;

// Keywords
// Logic: "keywords (TV)" or "pagetitle"
$kw = ($arr['keywords'])?($arr['keywords']):($title);
$output.='<meta name="keywords" content="'.$kw.'"/>'.$n;

// Description
// Logic: "description" or "introtext" or title from above
$description = ($arr['description'])?($arr['description']):($arr['introtext']);
if(empty($description)) $description = $title;
$output.='<meta name="description" content="'.$description.'"/>'."\n";

if($config['debug']==0) print $output;