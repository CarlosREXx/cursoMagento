<?php

namespace TorinoMotors\ModuleAjax\Controller\Adminhtml\Marcas;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param \TorinoMotors\Refacciones\Model\Suscription $suscriptionFactory
     */

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ){
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */

     public function execute()
     {
         $marca = $this->getRequest()->getParam("marca_id");
         $resultPage = $this->resultPageFactory->create();
         $resultPage->getConfig()->getTitle()->prepend(__("Editar Registro"));
         return $resultPage;
     }
}