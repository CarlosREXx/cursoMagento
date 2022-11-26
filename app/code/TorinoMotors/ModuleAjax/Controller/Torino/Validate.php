<?php

namespace TorinoMotors\ModuleAjax\Controller\Torino;

use \TorinoMotors\ModuleAjax\Controller\Torino\GeneratePdf;

class Validate extends GeneratePdf
{
    public function execute()
    {
        $result = $this->resultRedirectFactory->create();
        if(!$this->getRequest()->isPost()){
            $param = $this->getRequest()->getParam('id_rh');
            if(!$param){
                $this->managerInterface->addErrorMessage(__('Se necesitan algunos parametros para poder continuar'));
                return $result->setPath('ajaxrequest/index');
            }
            if($data = $this->getDataFiesta($param)){
                $model = $this->fiestaFactory->create();
                $model->load($data[0]['id']);
                $model->addData(['asistencia' => 1]);
                try{
                    $model->save();
                }catch(\Magento\Framework\Exception\LocalizedException $e){
                    $this->managerInterface->addErrorMessage($e->getMessage());
                    return $result->setPath('ajaxrequest/home/index');
                }
                $result = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
                return $result;
            }
            $this->managerInterface->addErrorMessage(__('El ID recibido no existe'));
            return $result->setPath('ajaxrequest/index/');
        }
    }
}
