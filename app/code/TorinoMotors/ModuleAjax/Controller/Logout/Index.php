<?php

namespace TorinoMotors\ModuleAjax\Controller\Logout;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Customer\Controller\Account\Logout
{
    public function execute()
    {
        parent::execute();
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $this->messageManager->addSuccessMessage('Haz cerrado sesión correctamente..');
        $resultRedirect->setPath('ajaxrequest/login');
        return $resultRedirect;
    }
}
