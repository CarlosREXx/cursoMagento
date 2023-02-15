<?php

namespace TorinoMotors\ModuleAjax\Observer;

class Redirecter implements \Magento\Framework\Event\ObserverInterface
{
    public function __construct(
        \Magento\Framework\App\Response\RedirectInterface $redirect
    ) {
        $this->redirect = $redirect;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $request = $observer->getRequest();
        // $controller = $observer->getControllerAction();
        // $redirect = "";
        // if($request->getModuleName() == 'customer'){
        //     if($request->getControllerName() == 'account'){
        //         $redirect = 'ajaxrequest/'.$request->getActionName();
        //     } else if($request->getControllerName() == 'section'){
        //         return;
        //     } else {
        //         $redirect = 'ajaxrequest/*/*';
        //     }
        //     $this->redirect->redirect($controller->getResponse(), $redirect, $request->getParams());
        // }
    }
}