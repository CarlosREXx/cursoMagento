<?php

namespace TorinoMotors\ModuleAjax\Controller\Adminhtml\Marcas;

class OrdersGridTable extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Distribuidoras'));
        $this->_addContent($this->_view->getLayout()->createBlock('TorinoMotors\ModuleAjax\Block\Adminhtml\Marcas\OrdersGridTable'));
        $this->_view->renderLayout();
    }


}