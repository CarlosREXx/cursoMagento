<?php

namespace TorinoMotros\Refacciones\Model\ResourceModel;

class Suscription extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init("motors_suscription", "suscription_id");
    }
}