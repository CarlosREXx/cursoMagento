<?php

namespace TorinoMotors\ModuleAjax\Controller\Result;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use TorinoMotors\ModuleAjax\Service\jServiceAPI;

class Result extends Action
{
    /**
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $resultJsonFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        jServiceAPI $jServiceAPI
    ){
        $this->_jServiceApi = $jServiceAPI;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    } 

    public function execute()
    {   
        /**
         * @return Array
         */
        $result = $this->resultJsonFactory->create();
        $numero = $this->getRequest()->getParam('numero');
        $array = Array("numero" => $numero,
                    "data" => $this->_jServiceApi->execute());

        $result->setData($array);
        return $result;
    }
}