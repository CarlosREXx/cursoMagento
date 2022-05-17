<?php

namespace TorinoMotors\ModuleAjax\Controller\Adminhtml\Marcas;

class Lugares extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $resultLayoutFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->getResponse()->setBody(
            $this->_view->getLayout()->createBlock('TorinoMotors\ModuleAjax\Block\Adminhtml\Marcas\Lugares')->toHtml());
    }
}