<?php

namespace TorinoMotors\ModuleAjax\Controller\Adminhtml\Marcas;

class Lugares extends \Magento\Backend\App\Action
// {
//     /**
//      * @var \Magento\Framework\View\Result\LayoutFactory
//      */
//     protected $resultLayoutFactory;

//     public function __construct(
//         \Magento\Backend\App\Action\Context $context
//     ) {
//         parent::__construct($context);
//     }

//     /**
//      * @return \Magento\Framework\View\Result\Layout
//      */
//     public function execute()
//     {
//         $this->_view->loadLayout();
//         $this->getResponse()->setBody(
//             $this->_view->getLayout()->createBlock('TorinoMotors\ModuleAjax\Block\Adminhtml\Marcas\Lugares')->toHtml());
//     }
// }
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
		$resultPage->getConfig()->getTitle()->prepend((__('Distribuidora')));
        $resultPage->addBreadcrumb(__('moduleajax'), __('Lugares'));
        $resultPage->addBreadcrumb(__('moduleajax'), __('Distribuidora Lugares'));

		return $resultPage;
	}


}