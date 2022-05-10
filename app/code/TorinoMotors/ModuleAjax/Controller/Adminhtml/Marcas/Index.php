<?php

namespace TorinoMotors\ModuleAjax\Controller\Adminhtml\Marcas;

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
        $resultPage->setActiveMenu("TorinoMotors_ModuleAjax::marcasautos");
        $resultPage->addBreadcrumb(__("Grid Marcas Autos"), __("Grid Maracas Autos"));
        $resultPage->addBreadcrumb(__("Manage Marcas Autos"), __("Manage Marcas Autos"));
        $resultPage->getConfig()->getTitle()->prepend(__("Marcas de Autos"));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed("TorinoMotors_ModuleAjax::marcasautos");
    }
}