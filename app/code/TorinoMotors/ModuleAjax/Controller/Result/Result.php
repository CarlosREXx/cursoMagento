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
        // $height = $this->getRequest()->getParam('height');
        // $weight = $this->getRequest()->getParam('weight');
        $result = $this->resultJsonFactory->create();
        $numero = $this->getRequest()->getParam('numero');
        //$resultPage = $this->resultPageFactory->create();
        $array = Array("numero" => $numero,
                    "data" => $this->_jServiceApi->execute());
        // $block = $resultPage->getLayout()
        //         ->createBlock('TorinoMotors\ModuleAjax\Block\Index')
        //         ->setTemplate('TorinoMotors_ModuleAjax::result.phtml')
        //         ->setData("numero", $numero)
        //         ->toHtml();
                //->setData("weight", $weight)

        $result->setData($array);
        return $result;
    }
}