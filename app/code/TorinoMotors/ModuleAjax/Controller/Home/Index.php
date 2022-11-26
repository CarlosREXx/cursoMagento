<?php 

namespace TorinoMotors\ModuleAjax\Controller\Home;

class Index extends \Magento\Customer\Controller\Account\Index
{   
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}