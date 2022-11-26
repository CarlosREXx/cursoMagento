<?php

namespace TorinoMotors\ModuleAjax\Controller\Plugin;

class RedirectCustomUrl
{

    public function afterExecute(
        \Magento\Customer\Controller\Account\LoginPost $subject,
        $result)
    {
        $customUrl = 'ajaxrequest/index';
        $result->setPath($customUrl);
        return $result;
    }

}