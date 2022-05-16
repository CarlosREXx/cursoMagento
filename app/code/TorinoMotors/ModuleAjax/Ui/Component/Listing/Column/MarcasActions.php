<?php

namespace TorinoMotors\ModuleAjax\Ui\Component\Listing\Column;

class MarcasActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    const URL_EDIT_PATH = "ajaxrequestadmin/marcas/edit";
    const URL_DELETE_PATH = "ajaxrequestadmin/marcas/delete";
    const URL_LUGARES_PATH = "ajaxrequestadmin/marcas/lugares";

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
                    if(isset($item["marca_id"])){
                        $item[$this->getData("name")] = [
                            "edit" => [
                                "href" => $this->urlBuilder->getUrl(
                                    static::URL_EDIT_PATH,
                                    [
                                        "marca_id" => $item["marca_id"],
                                    ]
                                    ),
                                "label" => __("Edit"),
                                ],
                            "delete" => [
                                "href" => $this->urlBuilder->getUrl(
                                    static::URL_DELETE_PATH,
                                    [
                                        "marca_id" => $item["marca_id"],
                                    ]
                                    ),
                                "label" => __("Delete"),
                                ],
                            'LugaresIndex' => [
                                'href' => $this->urlBuilder->getUrl(
                                    static::URL_LUGARES_PATH,
                                    [
                                        "marca_id" => $item["marca_id"],
                                    ],
                                    ),
                                // 'callback' => [
                                //     'provider' => 'oficina_refiere_listing.oficina_refiere_listing.modal_notas',
                                //     'target' => 'test_modal'
                                // ],
                                'label' => __('Ver Lugares')
                            ],
                        ];
                    }
                }
          }
          return $dataSource;
      }
}