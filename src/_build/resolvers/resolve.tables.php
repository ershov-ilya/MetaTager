<?php

if ($object->xpdo) {
	/** @var modX $modx */
	$modx =& $object->xpdo;

	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
			$modelPath = $modx->getOption('metatager_core_path', null, $modx->getOption('core_path') . 'components/metatager/') . 'model/';
			$modx->addPackage('metatager', $modelPath);

			$manager = $modx->getManager();
			$objects = array(
				'MetaTagerItem',
			);
			foreach ($objects as $tmp) {
				$manager->createObjectContainer($tmp);
			}
			break;

		case xPDOTransport::ACTION_UPGRADE:
			break;

		case xPDOTransport::ACTION_UNINSTALL:
			break;
	}
}
return true;
