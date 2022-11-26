<?php

namespace TorinoMotors\ModuleAjax\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use TorinoMotors\ModuleAjax\Service\jServiceAPI;
use TorinoMotors\ModuleAjax\Service\torinoServiceAPI;
use Magento\Framework\Async\DeferredInterface;

class Index extends Template
{
    protected $_tserviceApi;
    public function __construct(
        torinoServiceAPI $tserviceApi,
        Context $context,
        jServiceAPI $jServiceAPI,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ){
        $this->_tserviceApi = $tserviceApi;
        $this->_jServiceAPI = $jServiceAPI;
        $this->_storeManager = $storeManager;
        parent::__construct($context);    
    }

    public function torinoData(){
        return $this->_tserviceApi->getDataTorino();
    }

    public function motosData($categoryId = null, $categoryId2 = null)
    {
        return $this->_tserviceApi->getDataMotos($categoryId, $categoryId2);
    }

    public function getParamRh()
    {
        $params = $this->getRequest()->getParams();
        if(isset($params['id_rh'])){
            return $params['id_rh'];
        }
        return "";
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }
}