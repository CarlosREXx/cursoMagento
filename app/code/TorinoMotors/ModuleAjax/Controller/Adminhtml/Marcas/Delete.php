<?php

namespace TorinoMotors\ModuleAjax\Controller\Adminhtml\Marcas;

use Magento\Backend\App\Action\Context;
use TorinoMotors\ModuleAjax\Model\Marcas;
use TorinoMotors\ModuleAjax\Model\ImageUploader;

class Delete extends \Magento\Backend\App\Action
{
    /**
     *  @var TorinoMotors\Refacciones\Model\Suscription
     */
    protected $modelSuscription;
    /**
     * @param Context  $context
     * @param \TorinoMotors\Refacciones\Model\Suscription $modelSuscription
     */

     public function __construct(
        Context $context,
        Marcas $modelMarcas,
        ImageUploader $deleteImage
     ){
        parent::__construct($context);
        $this->modelMarcas = $modelMarcas;
        $this->deleteImage = $deleteImage;
     }

     protected function _isAllowed()
     {
         return $this->_authorization->isAllowed("TorinoMotors_ModuleAjax::marcas_delete");
     }

     /**
      * Delete Action
      * 
      * return \Magento\Framework\Controller\ResultInterface
      */

      public function execute()
      {
         $id = $this->getRequest()->getParam("marca_id");
         $marcasCollection = $this->modelMarcas;
         $resultRedirect = $this->resultRedirectFactory->create();
         if($id){
            try {
                $getDataCollection = $marcasCollection->load($id);
                $imagen = $getDataCollection->getImagen();
                if($imagen){
                    $deleteImgMessage = $this->deleteImage->removeFile("image/marcas/" . $imagen);
                    $this->messageManager->addSuccessMessage(__($deleteImgMessage));
                }
               $getDataCollection->delete();
               $this->messageManager->addSuccess(__("Registro eliminado correctamente"));
               return $resultRedirect->setPath("*/*/");
            } catch (\Exception $e) {
               $this->messageManager->addError($e->getMessage());
               return $resultRedirect->setPath("*/*/edit", ["id" => $id]);
            }
            $this->messageManager->addError(__("El registro no existe"));
            return $resultRedirect->setPath("*/*/");
         }
      }
}