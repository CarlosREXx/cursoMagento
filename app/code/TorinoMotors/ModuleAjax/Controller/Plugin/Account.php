<?php

namespace TorinoMotors\ModuleAjax\Controller\Plugin;

// class Account extends \Magento\Customer\Controller\Plugin\Account
// {

//     public function afterExecute(
//         \Magento\Customer\Controller\Account\Index $subject,
//         $result)
//     {
//         $customUrl = 'ajaxrequest/index';
//         return $result;
//     }

// }

use Closure;
use Magento\Customer\Controller\AccountInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\RequestInterface;

class Account extends \Magento\Customer\Controller\Plugin\Account
{
    public function __construct(
        RequestInterface $request,
        Session $customerSession,
        array $allowedActions = []
    ) {
        parent::__construct($request, $customerSession, array_flip($allowedActions));
        $this->request = $request;
        $this->allowedActions = $this->_getAllowedActions($allowedActions);
    }

    public function aroundExecute(AccountInterface $controllerAction, Closure $proceed)
    {
        if ($this->isActionAllowed()) {
            return $proceed();
        }
        return parent::aroundExecute($controllerAction, $proceed);
    }

    private function isActionAllowed(): bool
    {
        if($this->request->getModuleName() == 'ajaxrequest'){
            $action = strtolower($this->request->getControllerName()."/".$this->request->getActionName());
            return in_array($action, $this->allowedActions);
        }
        return false;
    }

    protected function _getAllowedActions($allowedActions){
        foreach($allowedActions as &$action){
            $actions = explode("/", $action);
            if(!isset($actions[1])){
                $actions[1] = 'index';
                $action = implode("/", $actions);
            }
        }
        return $allowedActions;
    }
}
