<?php

namespace TorinoMotors\ModuleAjax\Ui\Component\Listing;

use TorinoMotors\ModuleAjax\Model\ResourceModel\Distribuidoras\CollectionFactory;
use \Magento\Framework\Message\ManagerInterface;
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $addFieldStrategies;
    protected $addFilterStrategies;
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        ManagerInterface $messageManager,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->_messageInterface = $messageManager;
    }
 
    public function getCollection()
    {
        $this->_request = \Magento\Framework\App\ObjectManager::getInstance()->create(\Magento\Framework\App\RequestInterface::class);
        return $this->collection->addFieldToFilter("marca_id", $this->_request->getParam("marca_id"));
 
    }
 
    public function getData()
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }
        $param = $this->_request->getParam("marca_id");
        //$this->_messageInterface->addSuccess();
        return $this->getCollection()->toArray();
    }

    
}