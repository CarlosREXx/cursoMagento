<?php

namespace TorinoMotors\Refacciones\Controller\Index;


class Suscription extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $suscription = $this->_objectManager->create("TorinoMotors\Refacciones\Model\Suscription");

        $suscription->setFirstname("Carlos");
        $suscription->setLastname("Rocha");
        $suscription->setEmail("correo@correo.com");
        $suscription->setMessage("Mansaje Registro");

        $suscription->save();
        $this->getResponse()->setBody("Success");
    }
}