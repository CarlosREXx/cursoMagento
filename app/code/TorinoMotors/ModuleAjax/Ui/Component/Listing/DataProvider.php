<?php

namespace TorinoMotors\ModuleAjax\Ui\Component\Listing;

use \TorinoMotors\ModuleAjax\Model\ResourceModel\Distribuidoras\CollectionFactory;
use \Magento\Framework\Message\ManagerInterface;
use \TorinoMotors\ModuleAjax\Controller\Adminhtml\Marcas\Lugares;
// class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
// {
//     protected $collection;
//     protected $addFieldStrategies;
//     protected $addFilterStrategies;
//     protected $principal;

//     public function __construct(
//         $name,
//         $primaryFieldName,
//         $requestFieldName,
//         CollectionFactory $collectionFactory,
//         ManagerInterface $messageManager,
//         Lugares $lugares,
//         array $meta = [],
//         array $data = []
//     )
//     {
//         parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
//         $this->_lugares = $lugares;
//         $this->collection = $collectionFactory->create();
//         $this->_messageInterface = $messageManager;
//     }

//     public function getCollection()
//     {
//         $marca_id = $this->_lugares->getCacheData();
//         return $this->collection->addFieldToFilter("marca_id", $marca_id);

//     }
// }

class DataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
    protected function _initSelect()
    {
        $this->_request = \Magento\Framework\App\ObjectManager::getInstance()->create(\Magento\Framework\App\RequestInterface::class);
        parent::_initSelect();
        $this->addFieldToFilter('marca_id', $this->_request->getParam('recordId'));
        return $this;
    }
}
