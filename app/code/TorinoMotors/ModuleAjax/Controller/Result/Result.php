<?php

namespace TorinoMotors\ModuleAjax\Controller\Result;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\ResourceConnection;
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
        jServiceAPI $jServiceAPI,
        ResourceConnection $resource
    ){
        $this->_jServiceApi = $jServiceAPI;
        $this->_resource = $resource;
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
                    "data" => $this->_jServiceApi->execute(),
                    "Table" => $this->getTableData());

        $result->setData($array);
        return $result;
    }

    public function getTableData()
    {
        $connection = $this->_resource->getConnection();
        $myTable = $connection->getTableName('torinomotors_presenciaen');
        $sql     = $connection->select()->from(
            ["tn" => $myTable]
        ); 
        $result  = $connection->fetchAll($sql);
        return $result;
    }
}