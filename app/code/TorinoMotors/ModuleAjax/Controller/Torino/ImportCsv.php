<?php

namespace TorinoMotors\ModuleAjax\Controller\Torino;

class ImportCsv extends \Magento\Framework\App\Action\Action{

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory $_resultJsonFactory
     */
    protected $_resultJsonFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    protected $storeManager;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->_resultJsonFactory = $resultJsonFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }
    public function execute()
    {
        $result = $this->_resultJsonFactory->create();
        $file = fopen($this->getMediaUrl().'prueba.csv', 'r', '"');
        $header = fgetcsv($file);
        while($row = fgetcsv($file, 3000, ',')){
            $dataCount = count($row);
            if($dataCount < 1){
                continue;
            }

            $data = array();
            $data = array_combine($header, $row);
        }
        $result->setData(array('data' => $data, 'error' => false));
        return $result;
    }

    public function getMediaUrl(){
        $mediaUrl = $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'document/';
        return $mediaUrl;
    }
}