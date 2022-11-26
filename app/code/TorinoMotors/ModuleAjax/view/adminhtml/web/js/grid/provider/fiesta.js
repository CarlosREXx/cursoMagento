define([
    'jquery',
    'underscore',
    'Magento_Ui/js/grid/provider',
    'mage/url',
    'ko',
    'uiRegistry'
], function ($, _, provider, url, ko, uiRegistry) {
    'use_strict';

    return provider.extend({
        forceReload(){
            var cached = this.storage().getRequest(this.params);
            if (cached) {
                this.storage().removeRequest(cached);
            }
            this.reload();
        },
        reload: function(options){
            this._super();
        },
    });
});