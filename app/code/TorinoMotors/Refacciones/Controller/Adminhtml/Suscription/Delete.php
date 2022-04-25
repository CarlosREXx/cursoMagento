<?php

namespace TorinoMotors\Refacciones\Block\Adminhtml\Suscription;

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
          
      }
}