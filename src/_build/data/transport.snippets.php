<?php

$snippets = array();

$tmp = array(
    'MetaTager' => array(
        'file' => 'metatager',
        'description' => '',
    ),
);

$tmp = array(
    'adminToolBar' => array(
        'file' => 'admintoolbar',
        'description' => '',
    ),
);

$tmp = array(
    'CopyDate' => array(
        'file' => 'copydate',
        'description' => '',
    ),
);

$tmp = array(
    'GET' => array(
        'file' => 'get',
        'description' => '',
    ),
);

$tmp = array(
    'title' => array(
        'file' => 'title',
        'description' => '',
    ),
);

$tmp = array(
    'view_count' => array(
        'file' => 'view_count',
        'description' => '',
    ),
);

foreach ($tmp as $k => $v) {
	/* @avr modSnippet $snippet */
	$snippet = $modx->newObject('modSnippet');
	$snippet->fromArray(array(
		'id' => 0,
		'name' => $k,
		'description' => @$v['description'],
		'snippet' => getSnippetContent($sources['source_core'] . '/elements/snippets/snippet.' . $v['file'] . '.php'),
		'static' => BUILD_SNIPPET_STATIC,
		'source' => 1,
		'static_file' => 'core/components/' . PKG_NAME_LOWER . '/elements/snippets/snippet.' . $v['file'] . '.php',
	), '', true, true);

	$properties = include $sources['build'] . 'properties/properties.' . $v['file'] . '.php';
	$snippet->setProperties($properties);

	$snippets[] = $snippet;
}

unset($tmp, $properties);
return $snippets;