<?php

namespace TorinoMotors\ModuleAjax\Ui\Component\Listing\Column;

class DistribuidorasActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    // const URL_EDIT_PATH = "ajaxrequestadmin/marcas/edit";
    // const URL_DELETE_PATH = "ajaxrequestadmin/marcas/delete";
    // const URL_LUGARES_PATH = "ajaxrequestadmin/marcas/lugares";

    /**
     * @var \Magento\Framework\UrlInterface
     */

     protected $urlBuilder;

     /**
      * @param \Magento\Framework\UrlInterface                                $urlBuilder
      * @param \Magento\Framework\View\Element\UiComponent\ContextInterface   $context
      * @param \Magento\Framework\View\Element\UiComponentFactory             $uiComponentFactory
      * @param array
      * @param array
      */

      public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
      ){
          $this->urlBuilder = $urlBuilder;
          parent::__construct($context, $uiComponentFactory, $components, $data);
      }

      public function prepareDataSource(array $dataSource)
      {
          if(isset($dataSource["data"]["items"])){
                foreach($dataSource["data"]["items"] as &$item){
                    if(isset($item["dealer_place_id"])){
                        $item[$this->getData("name")] = [
                            // "edit" => [
                            //     "href" => $this->urlBuilder->getUrl(
                            //         static::URL_EDIT_PATH,
                            //         [
                            //             "marca_id" => $item["marca_id"],
                            //         ]
                            //         ),
                            //     "label" => __("Edit"),
                            //     ],
                            // "delete" => [
                            //     "href" => $this->urlBuilder->getUrl(
                            //         static::URL_DELETE_PATH,
                            //         [
                            //             "marca_id" => $item["marca_id"],
                            //         ]
                            //         ),
                            //     "label" => __("Delete"),
                            //     'confirm' => [
                            //         'title' => __('Borrar la marca {0}(ID:{1})', $item['marca_name'], $item['marca_id']),
                            //         'message' => __('Estas seguro de querer borrar {0}?', $item['marca_name'])]
                            //     ],
                            'edit' => [
                                'callback' => [
                                     'provider' => 'torinomotors_moduleajax_distribuidoras_listing.torinomotors_moduleajax_distribuidoras_listing.modal_distribuidoras_form',
                                     'target' => 'openModal',
                                     'params' => [
                                        "0" => [
                                            'callbackDone' => [
                                                'params' => [
                                                    '0' => [
                                                        'href' => '',
                                                        'id' => $item["dealer_place_id"],
                                                    ]
                                                ]
                                            ]
                                        ]
                                     ]
                                 ],
                                'label' => __('Editar')
                            ],
                        ];
                    }
                }
          }
          return $dataSource;
      }
}