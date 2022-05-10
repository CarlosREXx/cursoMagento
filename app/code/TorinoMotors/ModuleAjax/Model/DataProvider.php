<?php

namespace TorinoMotors\ModuleAjax\Model;

use TorinoMotors\ModuleAjax\Model\ResourceModel\Marcas\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $suscriptionCollectionFactory,
        array $meta = [], 
        array $data = []
    ){
        $this->collection = $suscriptionCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if(isset($this->loadedData)){
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach($items as $_suscription){
            $this->loadedData[$_suscription->getId()] = $_suscription->getData();
        }
        return $this->loadedData;
    }
}