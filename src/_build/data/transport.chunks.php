<?php

$chunks = array();

$chunk = $modx->newObject('modChunk', array(
    'name'          => 'adminToolBar',
    'description'   => 'Выводит тулбар для авторизованных пользователей',
    'snippet'       => getSnippetContent($sources['source_core'].'/elements/chunks/admintoolbar.chunk.html'),
));
$chunks[] = $chunk;

/*
$chunk = $modx->newObject('modChunk', array(
    'name'          => 'preHead',
    'description'   => 'Чанк preHead содержит вызов $MetaTager, подключает стили и JQuery, делает вызов ф-ции ready()',
    'snippet'       => getSnippetContent($sources['source_core'].'/elements/chunks/preHead.html'),
));
$chunks[] = $chunk;

$chunk = $modx->newObject('modChunk', array(
    'name'          => 'postHead',
    'description'   => 'Чанк postHead завершает вызов ф-ции ready()',
    'snippet'       => getSnippetContent($sources['source_core'].'/elements/chunks/postHead.html'),
));
$chunks[] = $chunk;

$chunk = $modx->newObject('modChunk', array(
    'name'          => 'title',
    'description'   => 'Чанк $title пытается вывести *longtitle, если не получается выводит *pagetitle',
    'snippet'       => getSnippetContent($sources['source_core'].'/elements/chunks/title.html'),
));
$chunks[] = $chunk;

*/
return $chunks;
