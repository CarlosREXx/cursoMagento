<?php

namespace TorinoMotors\ModuleAjax\Controller\Result;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;

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
        JsonFactory $resultJsonFactory
    ){
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    } 

    public function execute()
    {
        // $height = $this->getRequest()->getParam('height');
        // $weight = $this->getRequest()->getParam('weight');
        $numero = $this->getRequest()->getParam('numero');
        $result = $this->resultJsonFactory->create();
        $resultPage = $this->resultPageFactory->create();

        $block = $resultPage->getLayout()
                ->createBlock('TorinoMotors\ModuleAjax\Block\Index')
                ->setTemplate('TorinoMotors_ModuleAjax::result.phtml')
                ->setData("numero", $numero)
                ->toHtml();
                //->setData("weight", $weight)

        $result->setData(['output' => $block]);
        return $result;
    }
}