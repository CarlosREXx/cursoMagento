<?php

namespace TorinoMotors\Refacciones\Controller\Adminhtml\Suscription;

use Magento\Backend\App\Action\Context;
use TorinoMotors\Refacciones\Model\Suscription;

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
        Suscription $modelSuscription
     ){
        parent::__construct($context);
        $this->modelSuscription = $modelSuscription;
     }

     protected function _isAllowed()
     {
         return $this->_authorization->isAllowed("TorinoMotors_Refacciones::suscription_delete");
     }

     /**
      * Delete Action
      * 
      * return \Magento\Framework\Controller\ResultInterface
      */

      public function execute()
      {
         $id = $this->getRequest()->getParam("suscription_id");
         $suscriptioCollection = $this->modelSuscription;
         $resultRedirect = $this->resultRedirectFactory->create();
         if($id){
            try {
               $suscriptioCollection->load($id);
               $suscriptioCollection->delete();
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