<?php

namespace TorinoMotors\ModuleAjax\Block;


class Login extends \Magento\Customer\Block\Form\Login
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Model\Url $customerUrl,
        \Magento\Framework\Data\Form\FormKey $formKey,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $customerSession,
            $customerUrl,
            $data
        );
        $this->_formKey = $formKey;
    }

    public function getFormKey()
    {
         return $this->_formKey->getFormKey();
    }
}