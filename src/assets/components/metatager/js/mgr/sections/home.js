MetaTager.page.Home = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		components: [{
			xtype: 'metatager-panel-home', renderTo: 'metatager-panel-home-div'
		}]
	});
	MetaTager.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(MetaTager.page.Home, MODx.Component);
Ext.reg('metatager-page-home', MetaTager.page.Home);