<?php

namespace TorinoMotors\ModuleAjax\Ui\DataSource\Distribuidoras;

use Magento\Framework\App\RequestInterface;
use TorinoMotors\ModuleAjax\Model\ResourceModel\Distribuidoras\CollectionFactory;

class ModalDataSource extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        RequestInterface $requestInterface,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        CollectionFactory $suscriptionCollectionFactory,
        array $meta = [],
        array $data = []
    ){
        $this->request = $requestInterface;
        $this->storeManager = $storeManager;
        $this->collection = $suscriptionCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        $params = $this->request->getParams();
        if(isset($this->loadedData)){
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $this->loadedData[$model->getDealerPlaceId()] = $model->getData();
        }
        return $this->loadedData;
    }
}
