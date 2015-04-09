<?php

$settings = array();

$tmp = array(
    'title_delimiter' => array(
        'xtype' => 'textfield',
        'value' => '|',
        'area' => 'metatager_main',
    ),
    'favicon_path' => array(
        'xtype' => 'textfield',
        'value' => '/favicon.ico',
        'area' => 'metatager_main',
    )
);

foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => 'metatager_' . $k,
			'namespace' => PKG_NAME_LOWER,
		), $v
	), '', true, true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
