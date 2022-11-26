/**
 * @category   Universal
 * @package    Universal_Oficina
 * @author     cjayala@grupoautofin.com
 */

 define([
    'jquery',
    'underscore',
    //'./messages-provider',
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
        // onReload: function(data){
        //     if (this.firstLoad) {
        //         var id = '0'; // proximamente, obtener este id de request para abrir modal automatico
        //         if(item = this.storage().getByIds([id])[0]){
        //             var action = item.actions.notasIndexAction
        //             args = ['notasIndexAction', id, action]
        //             callback = action.callback;
        //             args.unshift(callback.target);
        //             callback = uiRegistry.async(callback.provider);
        //             callback.apply(callback, args);
        //         }
        //     }
        //     this._super();
        // }
    });
});