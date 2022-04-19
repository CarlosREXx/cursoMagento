<?php

namespace TorinoMotors\Refacciones\Model\ResourceModel\Suscription;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init(
            'TorinoMotors\Refacciones\Model\Suscription', 
            'TorinoMotors\Refacciones\Model\ResourceModel\Suscription'
        );
    }
}