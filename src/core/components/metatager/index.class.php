<?php

/**
 * Class MetaTagerMainController
 */
abstract class MetaTagerMainController extends modExtraManagerController {
	/** @var MetaTager $MetaTager */
	public $MetaTager;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('metatager_core_path', null, $this->modx->getOption('core_path') . 'components/metatager/');
		require_once $corePath . 'model/metatager/metatager.class.php';

		$this->MetaTager = new MetaTager($this->modx);
		$this->addCss($this->MetaTager->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->MetaTager->config['jsUrl'] . 'mgr/metatager.js');
		$this->addHtml('
		<script type="text/javascript">
			MetaTager.config = ' . $this->modx->toJSON($this->MetaTager->config) . ';
			MetaTager.config.connector_url = "' . $this->MetaTager->config['connectorUrl'] . '";
		</script>
		');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('metatager:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends MetaTagerMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}