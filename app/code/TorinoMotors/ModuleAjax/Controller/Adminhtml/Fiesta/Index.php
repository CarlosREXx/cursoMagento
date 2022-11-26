<?php

namespace TorinoMotors\ModuleAjax\Controller\Adminhtml\Fiesta;

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
        $resultPage->setActiveMenu("TorinoMotors_ModuleAjax::fiesta_gam");
        $resultPage->addBreadcrumb(__("Fiesta GAM Lista"), __("Fiesta GAM Lista"));
        $resultPage->getConfig()->getTitle()->prepend(__("Fiesta GAM Lista"));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed("TorinoMotors_ModuleAjax::fiesta_gam");
    }
}