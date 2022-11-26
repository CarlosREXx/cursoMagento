<?php

namespace TorinoMotors\ModuleAjax\Controller\Torino;

use Magento\Framework\App\Action\Context;
use \Magento\Framework\App\Response\Http\FileFactory;


class GeneratePdf extends \Magento\Framework\App\Action\Action
{

    const MEDIA_DIRECTORY = 'pub/media/image/';

    protected $resultJsonFactory;

    protected $fileFactory;

    /**
     *  @var \Magento\Framework\Message\ManagerInterface $managerInterface
     */
    protected $managerInterface;

    /**
     * @var \Endroid\QrCode\QrCode $_qrCode
     */
    protected $_qrCode;

    /**
     * @var \TorinoMotors\ModuleAjax\Model\ResourceModel\Fiesta\CollectionFactory $fiestaCollectionFactory
     */
    protected $fiestaCollectionFactory;

    /**
     * @var \TorinoMotors\ModuleAjax\Model\FiestaFactory $fiestaFactory
     */
    protected $fiestaFactory;

    /**
     * @var \Magento\Framework\Filesystem\Driver\File $fileDriver
     */
    protected $fileDriver;

    public function __construct(
        Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\Message\ManagerInterface $managerInterface,
        \Endroid\QrCode\QrCode $qrCode,
        \TorinoMotors\ModuleAjax\Model\ResourceModel\Fiesta\CollectionFactory $fiestaCollectionFactory,
        \TorinoMotors\ModuleAjax\Model\FiestaFactory $fiestaFactory,
        \Magento\Framework\Filesystem\Driver\File $fileDriver,
        FileFactory $fileFactory
    )
    {
        $this->fileFactory = $fileFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_qrCode = $qrCode;
        $this->managerInterface = $managerInterface;
        $this->fiestaCollectionFactory = $fiestaCollectionFactory;
        $this->fileDriver = $fileDriver;
        $this->fiestaFactory = $fiestaFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $error = true;
        $result = $this->resultJsonFactory->create();
        if($this->getRequest()->isPost()) {
            $paramId = $this->getRequest()->getParam('id');
            $file_name = '';
            $messageError = "";
            if ($paramId) {
                if($data = $this->getDataFiesta($paramId)){
                    $model = $this->fiestaFactory->create();
                    if($qr = $data[0]['qr_code']){
                        $file_exist = self::MEDIA_DIRECTORY.$qr;
                        if($validate = $this->fileDriver->isExists($file_exist)){
                            $this->returnJsonFactory($result, '', false, $this->_url->getBaseUrl().$file_exist);
                            return $result;
                        }else{
                            $dataArray = $this->generateQr($this->_url->getUrl('ajaxrequest/torino/validate', ['_current' => true, '_use_rewrite' => true ,'_query' => ['id_rh' => $paramId]]), $paramId);
                            $model->load($data[0]['id']);
                            $model->addData(['qr_code' => 'RH_' . $paramId . '.png']);
                            try{
                                $model->save();
                            }catch(\Magento\Framework\Exception\LocalizedException $e){
                                $this->returnJsonFactory($result, 'No se pudo guardar correctamente la información <Error Type>:<'.$e->getMessage().'>', true, "");
                                return $result;
                            }
                            $this->returnJsonFactory($result, $dataArray['message_error'], $dataArray['error'], $dataArray['qr']);
                            return $result;
                        }
                    }
                    $urlGenerate = $this->_url->getUrl('ajaxrequest/torino/validate', ['_current' => true, '_use_rewrite' => true ,'_query' => ['id_rh' => $paramId]]);
                    $dataArray = $this->generateQr($urlGenerate, $paramId);
                    $model->load($data[0]['id']);
                    $model->addData(['qr_code' => 'RH_' . $paramId . '.png']);
                    try{
                        $model->save();
                    }catch(\Magento\Framework\Exception\LocalizedException $e){
                        $this->returnJsonFactory($result, 'No se pudo guardar correctamente la información <Error Type>:<'.$e->getMessage().'>', true, "");
                        return $result;
                    }
                    $this->returnJsonFactory($result, $dataArray['message_error'], $dataArray['error'], $dataArray['qr']);
                    return $result;
                }else{
                    $messageError = "El Id Recibido no Existe";
                }
            }else{
                $messageError = 'No se ha recibido ningun Id';
            }
            return $result->setData(['error' => $error, 'qr' => $this->_url->getBaseUrl().$file_name, 'message_error' => $messageError]);
        }
        $this->returnJsonFactory($result, "Este método no es válido", true, "");
        return $result;
    }

    protected function getDataFiesta(string $id){
        $collection = $this->fiestaCollectionFactory->create();
        $data = $collection->addFieldToFilter('rh_id', ['eq' => $id ])->getData();
        if(count($data) > 0){
            return $data;
        }
        return false;
    }

    protected function returnJsonFactory(\Magento\Framework\Controller\Result\Json $result, string $message = "", bool $error, string $data = ""){
        $result->setData(['error' => $error, 'qr' => $data, 'message_error' => $message]);
    }

    protected function generateQr(string $url, string $id){
        try {
            $this->_qrCode->setText($url);
            $this->_qrCode->setSize(300);
            $this->_qrCode->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0));
            $this->_qrCode->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0));
            $this->_qrCode->setLogoPath($this->_url->getBaseUrl() . self::MEDIA_DIRECTORY .'marcas/favicon.png');
            $this->_qrCode->setLogoWidth(50);
            $this->_qrCode->setLogoHeight(50);
            $this->_qrCode->setLabel('Bienvenido Colaborador');
            $this->_qrCode->setLabelFontSize(16);
            $file = 'RH_' . $id . '.png';
            $file_name = self::MEDIA_DIRECTORY.$file;
            $this->_qrCode->writeFile($file_name);
            return ['qr' => $this->_url->getBaseUrl().$file_name, 'error' => false, 'message_error' => ""];
            //$error = false;
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            return ['qr' => "", 'error' => true, 'message_error' => "Un Error ocurrio al tratar de generar tu Qr <Error Type>: <".$e->getMessage().">"];
        }
    }
}
