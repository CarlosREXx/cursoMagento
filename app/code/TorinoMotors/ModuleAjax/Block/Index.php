<?php

namespace TorinoMotors\ModuleAjax\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use TorinoMotors\ModuleAjax\Service\jServiceAPI;

class Index extends Template
{
    public function __construct(
        Context $context,
        jServiceAPI $jServiceAPI,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ){
        $this->_jServiceAPI = $jServiceAPI;
        $this->_storeManager = $storeManager;
        parent::__construct($context);    
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

//     public function getHeightData()
//     {
//         return $this->getHeight();
//     }

//     public function getWeightData()
//     {
//         return $this->getWeight();
//     }

    public function getNumeroData()
    {
        return $this->getNumero();
    }

    public function getServiceApi()
    {
        return $this->_jServiceAPI->execute();
    }
}