/**
 * @category   Universal
 * @package    Universal_Oficina
 * @author     cjayala@grupoautofin.com
 */

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
        // defaults: {
        //     links: {
        //         status: 'oficina_refiere_listing.oficina_refiere_listing.modal_notas:status'
        //     }
        // },
        // initObservable: function () {
        //     this._super();
        //     this.observe(['status']);
        //     return this;
        // },
        forceReload(){
            var cached = this.storage().getRequest(this.params);
            if (cached) {
                this.storage().removeRequest(cached);
            }
            this.reload();
            var oldStatus = this.source.storage().getByIds([this.params.recordId])[0].status;
            if(this.status() != oldStatus){
                this.source.forceReload();
            }
        },
        // startDelete: function (action, data) {
        //     data.namespace = data.params.namespace;
        //     var self = this;
        //     $.ajax({
        //         url: url.build('/admin/oficina/refiere/nota_massDeletePost'),
        //         type: 'POST',
        //         dataType: 'json',
        //         data: data,
        //         showLoader: true,
        //         success: function(data, status, xhr) {
        //             if(!data.error){
        //                 self.forceReload();
        //                 self.replaceMessages(data.messages);
        //             }else{
        //                 var message = "Error in request ("+data.code+")";
        //                 console.error(message);
        //                 this.error(xhr, status, message);
        //             }
        //         },
        //         error: function (xhr, status, errorThrown) {
        //             var detail = status+' '+xhr.status+' '+errorThrown;
        //             alert('Error happens. Try again. ('+detail+')');
        //         }
        //     });
        // }
    });
});