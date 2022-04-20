<?php

namespace TorinoMotors\Refacciones\Model\ResourceModel;

class Suscription extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ){
        parent::__construct($context);
    }
    protected function _construct()
    {
        $this->_init("motors_suscription", "suscription_id");
    }
}