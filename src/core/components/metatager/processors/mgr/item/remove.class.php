<?php

/**
 * Remove an Items
 */
class MetaTagerItemRemoveProcessor extends modObjectProcessor {
	public $objectType = 'MetaTagerItem';
	public $classKey = 'MetaTagerItem';
	public $languageTopics = array('metatager');
	//public $permission = 'remove';


	/**
	 * @return array|string
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		$ids = $this->modx->fromJSON($this->getProperty('ids'));
		if (empty($ids)) {
			return $this->failure($this->modx->lexicon('metatager_item_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var MetaTagerItem $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('metatager_item_err_nf'));
			}

			$object->remove();
		}

		return $this->success();
	}

}

return 'MetaTagerItemRemoveProcessor';