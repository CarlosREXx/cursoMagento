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
            modalComponent: 'torinomotors_moduleajax_fiesta_listing.torinomotors_moduleajax_fiesta_listing.modal_add_cvs',
            fiestaListingComponent: 'torinomotors_moduleajax_fiesta_listing.torinomotors_moduleajax_fiesta_listing_data_source',
            fiestaFileUploaderComponent: 'torinomotors_moduleajax_fiesta_listing.torinomotors_moduleajax_fiesta_listing.modal_add_cvs.general.csv',
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
        // openModal: function (index, recordId, action) {
        //     debugger;
        //     this.recordId(recordId);
        //     this._super();
        // },
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
        // forceReload: function () {
        //     debugger;
        //     var source = uiRegistry.get(this.distribuidorasSource);
        //     if(source){
        //         source.forceReload();
        //     }
        // },
        actionDone: function(){
            debugger;
            var arrayFile = this.source.csv;
            var modal = uiRegistry.get(this.modalComponent);
            var listing = uiRegistry.get(this.fiestaListingComponent);
            var uploader = uiRegistry.get(this.fiestaFileUploaderComponent);
            if(arrayFile.length < 1){
                alert('Necesitas agregar un archivo CSV para importar su información');
                return;
            }
            $.ajax({
                url: url.build('/admin/ajaxrequestadmin/fiesta/post'),
                type: 'POST',
                dataType: 'json',
                data: {csv: arrayFile},
                showLoader: true,
                success: function(data, status, xhr) {
                    if(!data['error']){
                        debugger;
                        modal.closeModal();
                        listing.forceReload();
                        uploader.clear();
                    }else{
                        var message = data['message'];
                        this.error(xhr, status, message);
                    }
                },
                error: function (xhr, status, errorThrown) {
                    var detail = status+' '+xhr.status+' '+errorThrown;
                    alert('Error happens. Try again. ('+detail+')');
                }
            });
        }
    });
});