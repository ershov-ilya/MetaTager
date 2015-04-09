var MetaTager = function (config) {
	config = config || {};
	MetaTager.superclass.constructor.call(this, config);
};
Ext.extend(MetaTager, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('metatager', MetaTager);

MetaTager = new MetaTager();