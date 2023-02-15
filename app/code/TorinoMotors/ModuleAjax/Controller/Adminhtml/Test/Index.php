<?php

namespace TorinoMotors\ModuleAjax\Controller\Adminhtml\Test;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ){
        parent::__construct($context);
        $this->resultPageFactory=$resultPageFactory;
    }

    public function execute(){
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu("TorinoMotors_ModuleAjax::test_collection");
        $resultPage->addBreadcrumb(__("Test Collection Grid"), __("Test Collection Grid"));
        $resultPage->getConfig()->getTitle()->prepend(__("Test Collection Grid"));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed("TorinoMotors_ModuleAjax::test_collection");
    }
}