<?php

namespace TorinoMotors\Refacciones\Ui\Component\Listing\Column;

class SuscriptionActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    const URL_EDIT_PATH = "refaccionesadmin/suscription/edit";
    const URL_DELETE_PATH = "refaccionesadmin/suscription/delete";

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
                    if(isset($item["suscription_id"])){
                        $item[$this->getData("name")] = [
                            "edit" => [
                                "href" => $this->urlBuilder->getUrl(
                                    static::URL_EDIT_PATH,
                                    [
                                        "suscription_id" => $item["suscription_id"],
                                    ]
                                    ),
                                "label" => __("Edit"),
                                ],
                            "delete" => [
                                "href" => $this->urlBuilder->getUrl(
                                    static::URL_DELETE_PATH,
                                    [
                                        "suscription_id" => $item["suscription_id"],
                                    ]
                                    ),
                                "label" => __("Delete"),
                                ],
                            ];
                    }
                }
          }
          return $dataSource;
      }
}