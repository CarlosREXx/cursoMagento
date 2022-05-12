<?php

namespace TorinoMotors\ModuleAjax\Controller\Adminhtml\Marcas;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use TorinoMotors\ModuleAjax\Model\Marcas;
use TorinoMotors\ModuleAjax\Model\ImageUploader;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var Suscription
     */
    protected $uiExampleModel;
    /**
     * @var Session
     */
    protected $adminSession;
    /**
     * @param Action\Context $context
     * @param Suscription $uiExampleModel
     * @param Session $adminSession
     */
    public function __construct(
        Action\Context $context,
        ImageUploader $imageUploader,
        Marcas $uiExampleModel,
        Session $adminSession
    ){
        parent::__construct($context);
        $this->uiExampleModel = $uiExampleModel;
        $this->adminSession = $adminSession;
        $this->_imageUploader = $imageUploader;
    }

    /**
     * Save Suscription record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute(){
        $setData = [];
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if($data){
            foreach($data as $key => $value){
                !($key == "imagen") ? $setData[$key] = $value : $setData[$key] = $value[0]["name"];
            }
            $marcaId = $this->getRequest()->getParam("marca_id");
            if($marcaId){
                $this->uiExampleModel->load($marcaId);
            }
            $image = $this->getRequest()->getParam("imagen");
            if($image){
                ($image[0]["name"] == $this->uiExampleModel->getImagen()) ? "" : $image = $this->_imageUploader->moveFileFromTmp($image[0]["name"]);
                if($this->uiExampleModel->getImagen()){
                    if(!($image[0]["name"] == $this->uiExampleModel->getImagen())){
                        $this->_imageUploader->removeFile("image/marcas/" . $this->uiExampleModel->getImagen());
                    }
                } 
            }

            // if (!$image){
            //     $this->messageManager->addError(__("No image upload"));
            //     return $resultRedirect->setPath("*/*/add");
            // }
            $this->uiExampleModel->setData($setData);
            try{
                $this->uiExampleModel->save();
                $this->messageManager->addSuccess(__("El registro se ha guardado"));
                $this->adminSession->setFormData(false);
                if($this->getRequest()->getParam("back")){
                    if($this->getRequest()->getParam("back") == "add"){
                        return $resultRedirect->setPath("*/*/add");
                    }elseif($this->getRequest()->getParam("back") == "addClose"){
                        return $resultRedirect->setPath("*/*/");
                    }//else{
                    //     return $resultRedirect->setPath("*/*/edit", ["marca_id" => $this->uiExampleModel->getMarcaId(), "_current" => true]);
                    // }
                }
            }catch(\Magento\Framework\Exception\LocalizedException $e){
                $this->messageManager->addError($e->getMessage());
            }catch(\RuntimeException $e){
                $this->messageManager->addError($e->getMessage());
            }catch(\Exception $e){
                $this->messageManager->addException($e, __("Se produjo un error al guardar los datos"));
            }
            //$this->_getSession()->setFormData($data);
            return $resultRedirect->setPath("*/*/", ["marca_id" => $this->uiExampleModel->getMarcaId(), "_current" => true]);
        }
        return $resultRedirect->setPath("*/*/");
    }
}