<?php

/**
 * Create an Item
 */
class MetaTagerItemCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'MetaTagerItem';
	public $classKey = 'MetaTagerItem';
	public $languageTopics = array('metatager');
	//public $permission = 'create';


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$name = trim($this->getProperty('name'));
		if (empty($name)) {
			$this->modx->error->addField('name', $this->modx->lexicon('metatager_item_err_name'));
		}
		elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
			$this->modx->error->addField('name', $this->modx->lexicon('metatager_item_err_ae'));
		}

		return parent::beforeSet();
	}

}

return 'MetaTagerItemCreateProcessor';