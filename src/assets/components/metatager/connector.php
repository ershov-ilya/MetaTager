<?php
/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var MetaTager $MetaTager */
$MetaTager = $modx->getService('metatager', 'MetaTager', $modx->getOption('metatager_core_path', null, $modx->getOption('core_path') . 'components/metatager/') . 'model/metatager/');
$modx->lexicon->load('metatager:default');

// handle request
$corePath = $modx->getOption('metatager_core_path', null, $modx->getOption('core_path') . 'components/metatager/');
$path = $modx->getOption('processorsPath', $MetaTager->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));