<?php

namespace TorinoMotors\ModuleAjax\Controller\Logout;

use Magento\Framework\Controller\ResultFactory;

class Success extends \Magento\Customer\Controller\Account\LogoutSuccess
{
    public function execute()
    {
        $this->messageManager->addSuccessMessage('Haz cerrado sesión correctamente..');
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('ajaxrequest/login');
        return $resultRedirect;
    }
}