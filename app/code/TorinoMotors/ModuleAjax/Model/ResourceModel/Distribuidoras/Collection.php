<?php

namespace TorinoMotors\ModuleAjax\Model\ResourceModel\Distribuidoras;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'TorinoMotors\ModuleAjax\Model\Distribuidoras', 
            'TorinoMotors\ModuleAjax\Model\ResourceModel\Distribuidoras'
        );
    }
}