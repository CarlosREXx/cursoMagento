define([
    'jquery',
    'underscore',
    'Magento_Ui/js/modal/modal-component',
    'mage/url',
    'ko',
    'uiRegistry'
], function ($, _, modal, url, ko, uiRegistry) {
    'use_strict';
    return modal.extend({
        defaults: {
            distribuidorasFilterComponent: 'torinomotors_moduleajax_distribuidoras_listing.torinomotors_moduleajax_distribuidoras_listing.listing_top.listing_filters',
            distribuidorasSource: 'torinomotors_moduleajax_distribuidoras_listing.torinomotors_moduleajax_distribuidoras_listing_data_source',
            columnIds: 'torinomotors_moduleajax_distribuidoras_listing.torinomotors_moduleajax_distribuidoras_listing.spinner_columns.ids',
            listens: {
                recordId: 'onRecordIdChange',
                status: 'onStatusChange'
            }
        },
        initObservable: function () {
            this._super();
            this.observe(['recordId', 'status']);
            return this;
        },
        openModal: function (index, recordId, action) {
            debugger;
            this.recordId(recordId);
            this._super();
        },
        onRecordIdChange: function (recordId) {
            //debugger;
            this.changeCurrentStatus(recordId);
            if(filter = uiRegistry.get(this.distribuidorasFilterComponent)){
                filter.clear()
            };
            if(columnIds = uiRegistry.get(this.columnIds)){
                columnIds.deselectAll();
            };
            // if(source = uiRegistry.get(this.distribuidorasSource)){
            //     source.clearMessages();
            // }
        },
        onStatusChange: function (status) {
            this.changeTitle(status);
        },
        changeCurrentStatus: function (recordId){
            if(item = this.source.storage().getByIds([recordId])[0]){
                this.status(item.status);
            }
        },
        forceReload: function () {
            debugger;
            var source = uiRegistry.get(this.distribuidorasSource);
            if(source){
                source.forceReload();
            }
        },
    });
});