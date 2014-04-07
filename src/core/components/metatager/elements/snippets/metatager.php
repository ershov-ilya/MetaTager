<?php
/**
 * Snippet: MetaTager
 * Project: MetaTager
 * File:    metatager.php
 * Update date: 07.04.14, time: 19:20
 * Author:  ershov-ilya
 * GitHub:  http://github.com/ershov-ilya
 * Edited in PhpStorm.
 */

/* @var modX $modx */
/* @var modResource $resource */

function resetTV($modx, $id, $TVname)
{
	$tv = $modx->getObject('modTemplateVar', array('name'=>$TVname));
	if(!empty($tv))
	{
	  $tv->setValue($id, '');
	  $tv->save();
	}
}

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
	'delimiter' => '-',
	'migrate' => '1',
	'minify' => '0',
	'debug' => '0'
);
$config = array_merge($defconfig, $scriptProperties);
$n="\n";
if($config['minify']) $n='';
$output=$n;
$id=$config['id'];

/* READ values
------------------------------------*/
$resource = $modx->getObject('modResource', $id);

// System options
$arr['modx_charset'] = $modx->getOption('modx_charset');
$arr['site_url']	 = $modx->getOption('site_url');
$arr['site_name']	 = $modx->getOption('site_name');
$arr['cultureKey']	 = $modx->getOption('cultureKey');

// Page values
$arr['pagetitle'] = $resource->get('pagetitle');
$arr['longtitle'] = $resource->get('longtitle');
$arr['introtext'] = $resource->get('introtext');
$arr['description'] = $resource->get('description');

// Keywords
if(!empty($config['keywords'])) $arr['keywords'] = $config['keywords'];
else $arr['keywords'] = $resource->getTVValue($config['kwTVname']);

// SEOPro compability
$seoPro = $modx->getService('seopro','seoPro',$modx->getOption('seopro.core_path',null,$modx->getOption('core_path').'components/seopro/').'model/seopro/',$config);
$objSeoKeywords = $modx->getObject('seoKeywords', array('resource' => $id));

// ?????????„?????°?†???? ???»?? ???µ?€?µ???????° ?????µ?… ???»???‡?µ???‹?… ???»????
if(!$objSeoKeywords)
{
	$objSeoKeywords = $modx->newObject('seoKeywords', array('resource' => $id));
	if($objSeoKeywords)
	{
	  $objSeoKeywords->set('keywords', $arr['keywords']);
	  $objSeoKeywords->save();  
	  if($config['migrate']) resetTV($modx, $id, $config['kwTVname']);
	}
}
if($objSeoKeywords){
	$seoKeywords = $objSeoKeywords->get('keywords');
	if($seoKeywords == $arr['keywords'] && $config['migrate'])
	{
		resetTV($modx, $id, $config['kwTVname']);
	}
	elseif(empty($seoKeywords) && !empty($arr['keywords']))
	{
		$objSeoKeywords->set('keywords', $arr['keywords']);
		$objSeoKeywords->save();

		if($config['migrate']) resetTV($modx, $id, $config['kwTVname']);
	}
	elseif(!empty($seoKeywords))
	{
		$arr['keywords'] = $seoKeywords;
	}
}
else
{
	$arr['keywords'] = $arr['pagetitle'];
}

// TVs
$arr['specific_title'] = $resource->getTVValue($config['spec_titleTVname']);

// Snippets return
$arr['full_url'] = $modx->makeUrl($id, $config['context'], '', $config['scheme']);

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
$output.='<base href="'.$arr['site_url'].'" />'.$n;
$output.='<meta charset="'.$arr['modx_charset'].'" />'.$n;
$output.='<meta http-equiv="content-language" content="'.$arr['cultureKey'].'" />'.$n;
if(isset($config['adaptive'])) $output.='<meta name="viewport" content="width=device-width, initial-scale=1">'.$n;
$output.='<link rel="canonical" href="'.$arr['full_url'].'" />'.$n;
$output.='<link rel="shortcut icon" href="'.$config['favicon_path'].'" />'.$n;

// Title
// Logic: "specific_title (TV)" or "longtitle - sitename" or "pagetitle - sitename"
$title = $arr['pagetitle'].' '.$config['delimiter'].' '.$arr['site_name'];
if(!empty($arr['longtitle'])) $title = $arr['longtitle'].' '.$config['delimiter'].' '.$arr['site_name'];
if(!empty($arr['specific_title'])) $title = $arr['specific_title'];
$output.='<title>'.$title.'</title>'.$n;

// Keywords
// Logic: "keywords (TV)" or "pagetitle"
$kw = ($arr['keywords'])?($arr['keywords']):($title);
$output.='<meta name="keywords" content="'.$kw.'" />'.$n;

// Description
// Logic: "description" or "introtext" or title from above
$description = ($arr['description'])?($arr['description']):($arr['introtext']);
if(empty($description)) $description = $title;
$output.='<meta name="description" content="'.$description.'" />'."\n";

if($config['debug']==0) print $output;
