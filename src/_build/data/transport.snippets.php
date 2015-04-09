<?php

$snippets = array();


$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'name' => 'MetaTager',
    'description' => 'Этот сниппет выводит все необходимые мета-теги: title, description, keywords, base, link[canonical] and favicon. It tries to fill all the fields by known data, and do this maximum fast.',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/metatager.snippet.php'),
),'',true,true);
$snippets[] = $snippet;

$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'name' => 'adminToolBar',
    'description' => 'Выводит тулбар для авторизованных пользователей',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/admintoolbar.snippet.php'),
),'',true,true);
$snippets[] = $snippet;

$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'name' => 'CopyDate',
    'description' => 'Сниппет для вывода текущего года и знака копирайта',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/copydate.snippet.php'),
),'',true,true);
$snippets[] = $snippet;

$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'name' => 'GET',
    'description' => 'Сниппет для получения значения поля $_GET, $_POST или $_REQUEST',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/get.snippet.php'),
),'',true,true);
$snippets[] = $snippet;

$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'name' => 'parent',
    'description' => 'Сниппет для получения ID родителя или любого другого поля у текущего ресурса, если указать параметр &id - можно получить поля родителя любого другого ресурса',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/parent.snippet.php'),
),'',true,true);
$snippets[] = $snippet;

$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'name' => 'title',
    'description' => 'Сниппет который выводит longtitle, а если там пусто - выведет pagetitle',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/title.snippet.php'),
),'',true,true);
$snippets[] = $snippet;


return $snippets;