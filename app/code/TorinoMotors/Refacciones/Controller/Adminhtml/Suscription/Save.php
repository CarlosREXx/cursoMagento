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
    public function execute(){

    }
}