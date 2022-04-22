<?php

namespace TorinoMotors\Refacciones\Controller\Adminhtml\Suscription;

use Magento\Backend\App\Action\Context;
use Megento\Framework\View\Result\PageFactory;

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
        $this->resultFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */

     public function execute()
     {
         $resultPage = $this->resultFactory->create();
         $resultPage->getConfig()->getTitle()->prepend(__("Editar Registro"));
     }
}
