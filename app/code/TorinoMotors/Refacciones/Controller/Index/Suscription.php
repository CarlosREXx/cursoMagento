<?php

namespace TorinoMotors\Refacciones\Controller\Index;

use TorinoMotors\Refacciones\Model\Suscription as SuscriptionModel;

class Suscription extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $suscription = $this->_objectManager->create("TorinoMotors\Refacciones\Model\Suscription");

        $suscription->setFirstname("Carlos");
        $suscription->setLastname("Rocha");
        $suscription->setEmail("correomail@mail.com");
        $suscription->setMessage("Mensaje Registro de Carlos");
        $suscription->setStatus(SuscriptionModel::STATUS_DECLINED);

        $suscription->save();
        $this->getResponse()->setBody("Success");
    }
}