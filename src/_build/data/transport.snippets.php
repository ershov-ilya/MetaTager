<?php

$snippets = array();

$tmp = array(
    'MetaTager' => array(
        'file' => 'metatager',
        'description' => 'Этот сниппет выводит все необходимые мета-теги: title, description, keywords, base, link[canonical] and favicon. It tries to fill all the fields by known data, and do this maximum fast.',
    ),
    'adminToolBar' => array(
        'file' => 'admintoolbar',
        'description' => 'Выводит тулбар для авторизованных пользователей',
    ),
    'CopyDate' => array(
        'file' => 'copydate',
        'description' => 'Сниппет для вывода текущего года и знака копирайта',
    ),
    'GET' => array(
        'file' => 'get',
        'description' => 'Сниппет для получения значения поля $_GET, $_POST или $_REQUEST',
    ),
    'title' => array(
        'file' => 'title',
        'description' => 'Сниппет который выводит longtitle, а если там пусто - выведет pagetitle',
    ),
    'view_count' => array(
        'file' => 'view_count',
        'description' => 'Подсчёт количества просмотров страницы',
    )
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