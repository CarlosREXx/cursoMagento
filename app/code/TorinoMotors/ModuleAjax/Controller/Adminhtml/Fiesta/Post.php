<?php

namespace TorinoMotors\ModuleAjax\Controller\Adminhtml\Fiesta;

class Post extends \Magento\Backend\App\Action{

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory $_resultJsonFactory
     */
    protected $_resultJsonFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    protected $storeManager;

    /**
     * @var \TorinoMotors\ModuleAjax\Model\ImageUploader $imageUploader
     */
    protected $imageUploader;

    /**
     * @var \TorinoMotors\ModuleAjax\Model\FiestaFactory $fiestaFactory
     */
    protected $fiestaFactory;

    protected $headersTable = ['rh_id', 'name', 'invitados'];

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \TorinoMotors\ModuleAjax\Model\ImageUploader $imageUploader,
        \TorinoMotors\ModuleAjax\Model\FiestaFactory $fiestaFactory
    )
    {
        $this->_resultJsonFactory = $resultJsonFactory;
        $this->storeManager = $storeManager;
        $this->imageUploader = $imageUploader;
        $this->fiestaFactory = $fiestaFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        if(!$this->getRequest()->isPost()){
            $this->getMessageManager()->addErrorMessage(__('An error occurred while processing your form.') . " (ADMREFPST01)");
            return $this->resultRedirectFactory->create()->setPath('*/*');
        }
        $fileArray = $this->getRequest()->getParam('csv');
        try{
            $this->imageUploader->setBaseTmpPath('tmp/csv');
            $this->imageUploader->setBasePath('document/csv');
            $this->imageUploader->moveFileFromTmp($fileArray[0]['file']);
        }catch(\Magento\Framework\Exception\LocalizedException $e){
            $this->getMessageManager()->addErrorMessage(__($e->getMessage()));
            return $this->resultRedirectFactory->create()->setPath('*/*');
        }
        $result = $this->_resultJsonFactory->create();
        try{
            $file = fopen($this->getMediaUrl().$fileArray[0]['file'], 'r', '"');
        }catch(\Exception $ex){
            $this->getMessageManager()->addErrorMessage(__($ex->getMessage()));
            return $this->resultRedirectFactory->create()->setPath('*/*');
        }
        $model = $this->fiestaFactory->create();
        $error = false;
        $header = fgetcsv($file);
        foreach($this->headersTable as $head){
            if(in_array($head, $header)){
                continue;
            }
            $notFound[] = $head;
            $error = true;
        }
        if($error){
            try{
                $this->imageUploader->removeFile('document/csv/'.$fileArray[0]['file']);
            }catch(\Magento\Framework\Exception\LocalizedException $e){
                $this->getMessageManager()->addErrorMessage(__($e->getMessage()));
                return $this->resultRedirectFactory->create()->setPath('*/*');
            }
            $message = __('Son necesarios los siguientes campos el archivo csv: '. json_encode($notFound));
            $result->setData(array('error' => $error, 'message' => $message));
            return $result;
        }
        $position = null;
        foreach($header as $index => $cabecera){
            if($cabecera == 'invitados'){
                $position = $index;
            }
        }
        $connection = $model->getCollection()->getConnection();
        $tableName = $model->getCollection()->getMainTable();
        $connection->truncateTable($tableName);
        while($row = fgetcsv($file, 3000, ',')){
            $dataCount = count($row);
            if($dataCount < 1){
                continue;
            }
            $invitados = array();
            if(isset($row[$position])){
                $explodeString = explode(',', $row[$position]);
                foreach($explodeString as $string){
                    $invitados[] = ['name' => $string, 'asistencia' => 0];
                }
            }     
            $data = array();
            $data = array_combine($header, $row);
            if(count($invitados) > 0){
                $data['invitados'] = json_encode($invitados);
                $data['num_invitados'] = count($invitados);
            }else{
                $data['invitados'] = '';
                $data['num_invitados'] = 0;
            }
            $data['asistencia'] = 0;
            $model->setData($data);
            try{
                $model->save();
            }catch(\Magento\Framework\Exception\LocalizedException $exception){
                $this->getMessageManager()->addErrorMessage(__($exception->getMessage()));
                return $this->resultRedirectFactory->create()->setPath('*/*');
            }
        }
        try{
            $this->imageUploader->removeFile('document/csv/'.$fileArray[0]['file']);
            fclose($file);
        }catch(\Magento\Framework\Exception\LocalizedException $e){
            $this->getMessageManager()->addErrorMessage(__($e->getMessage()));
            return $this->resultRedirectFactory->create()->setPath('*/*');
        }
        $result->setData(array('error' => false));
        return $result;
    }

    public function getMediaUrl(){
        $mediaUrl = $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'document/csv/';
        return $mediaUrl;
    }
}
