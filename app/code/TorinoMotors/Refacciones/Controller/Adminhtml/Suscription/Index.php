<?php

namespace TorinoMotors\Refacciones\Controller\Adminhtml\Suscription;

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
        $resultPage->setActiveMenu("TorinoMotors_Refacciones::suscription");
        $resultPage->addBreadcrumb(__("Grid Suscription"), __("Grid Suscription"));
        $resultPage->addBreadcrumb(__("Manage Suscription"), __("Manage Suscription"));
        $resultPage->getConfig()->getTitle()->prepend(__("Suscriptions"));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed("TorinoMotors_Refacciones::suscription");
    }
}