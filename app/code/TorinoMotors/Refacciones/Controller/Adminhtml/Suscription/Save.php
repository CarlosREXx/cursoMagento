<?php

namespace TorinoMotors\Refacciones\Controller\Adminhtml\Suscription;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use TorinoMotors\Refacciones\Model\Suscription;

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
        Suscription $uiExampleModel,
        Session $adminSession
    ){
        parent::__construct($context);
        $this->uiExampleModel = $uiExampleModel;
        $this->adminSession = $adminSession;
    }

    /**
     * Save Suscription record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute(){
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if($data){
            $suscriptionId = $this->getRequest()->getParam("suscription_id");
            if($suscriptionId){
                $this->uiExampleModel->load($suscriptionId);
            }
            $this->uiExampleModel->setData($data);
            try{
                $this->uiExampleModel->save();
                $this->messageManager->addSuccess(__("El registro se ha guardado"));
                $this->adminSession->setFormData(false);
                if($this->getRequest()->getParam("back")){
                    if($this->getRequest()->getParam("back") == "add"){
                        return $resultRedirect->setPath("*/*/add");
                    }elseif($this->getRequest()->getParam("back") == "addClose"){
                        return $resultRedirect->setPath("*/*/", ["suscription_id" => $this->uiExampleModel->getSuscriptionId(), "_current" => true]);
                    }else{
                        return $resultRedirect->setPath("*/*/edit", ["suscription_id" => $this->uiExampleModel->getSuscriptionId(), "_current" => true]);
                    }
                }
            }catch(\Magento\Framework\Exception\LocalizedException $e){
                $this->messageManager->addError($e->getMessage());
            }catch(\RuntimeException $e){
                $this->messageManager->addError($e->getMessage());
            }catch(\Exception $e){
                $this->messageManager->addException($e, __("Se produjo un error al guardar los datos"));
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath("*/*/edit", ["suscription_id" => $this->getRequest()->getParam("suscription_id")]);
        }
        return $resultRedirect->setPath("*/*/");
    }
}