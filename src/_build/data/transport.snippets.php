<?php

$snippets = array();


$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'name' => 'MetaTager',
    'description' => 'This snippet outputs meta tags: title, description, keywords, base, link[canonical] and favicon. It tries to fill all the fields by known data, and do this maximum fast.',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/metatager.php'),
),'',true,true);
$snippets[] = $snippet;


return $snippets;