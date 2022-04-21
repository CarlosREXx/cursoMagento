<?php

namespace TorinoMotors\Refacciones\Controller\Adminhtml\Suscription;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use TorinoMotors\Refacciones\Model\ResourceModel\Suscription\CollectionFactory;

class MassDelete extends Action
{
    protected $collectionFactory;
    protected $filter;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ){
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();
            $count = 0;
            foreach($collection as $model){
                //$deleteItem = $this->_ObjectManager->get("TorinoMotors\Refacciones\Model\Suscription")->load($model->getId());
                $model->delete();
                $count++;
            }
    
            $this->messageManager->addSuccessMessage(__("Un total de $collectionSize Subscription(s) se han eliminado"));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath("*/*/");
    }
}