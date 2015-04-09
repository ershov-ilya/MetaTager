<?php

/**
 * The home manager controller for MetaTager.
 *
 */
class MetaTagerHomeManagerController extends MetaTagerMainController {
	/* @var MetaTager $MetaTager */
	public $MetaTager;


	/**
	 * @param array $scriptProperties
	 */
	public function process(array $scriptProperties = array()) {
	}


	/**
	 * @return null|string
	 */
	public function getPageTitle() {
		return $this->modx->lexicon('metatager');
	}


	/**
	 * @return void
	 */
	public function loadCustomCssJs() {
		$this->addCss($this->MetaTager->config['cssUrl'] . 'mgr/main.css');
		$this->addCss($this->MetaTager->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
		$this->addJavascript($this->MetaTager->config['jsUrl'] . 'mgr/misc/utils.js');
		$this->addJavascript($this->MetaTager->config['jsUrl'] . 'mgr/widgets/items.grid.js');
		$this->addJavascript($this->MetaTager->config['jsUrl'] . 'mgr/widgets/items.windows.js');
		$this->addJavascript($this->MetaTager->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->MetaTager->config['jsUrl'] . 'mgr/sections/home.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "metatager-page-home"});
		});
		</script>');
	}


	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->MetaTager->config['templatesPath'] . 'home.tpl';
	}
}