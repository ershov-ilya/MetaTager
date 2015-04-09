MetaTager.panel.Home = function (config) {
	config = config || {};
	Ext.apply(config, {
		baseCls: 'modx-formpanel',
		layout: 'anchor',
		/*
		 stateful: true,
		 stateId: 'metatager-panel-home',
		 stateEvents: ['tabchange'],
		 getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
		 */
		hideMode: 'offsets',
		items: [{
			html: '<h2>' + _('metatager') + '</h2>',
			cls: '',
			style: {margin: '15px 0'}
		}, {
			xtype: 'modx-tabs',
			defaults: {border: false, autoHeight: true},
			border: true,
			hideMode: 'offsets',
			items: [{
				title: _('metatager_items'),
				layout: 'anchor',
				items: [{
					html: _('metatager_intro_msg'),
					cls: 'panel-desc',
				}, {
					xtype: 'metatager-grid-items',
					cls: 'main-wrapper',
				}]
			}]
		}]
	});
	MetaTager.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(MetaTager.panel.Home, MODx.Panel);
Ext.reg('metatager-panel-home', MetaTager.panel.Home);
