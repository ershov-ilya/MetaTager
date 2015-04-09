<?php

/**
 * Get an Item
 */
class MetaTagerItemGetProcessor extends modObjectGetProcessor {
	public $objectType = 'MetaTagerItem';
	public $classKey = 'MetaTagerItem';
	public $languageTopics = array('metatager:default');
	//public $permission = 'view';


	/**
	 * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return mixed
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		return parent::process();
	}

}

return 'MetaTagerItemGetProcessor';