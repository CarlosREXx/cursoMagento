<?php

namespace TorinoMotors\ModuleAjax\Model\ResourceModel\Fiesta;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'TorinoMotors\ModuleAjax\Model\Fiesta', 
            'TorinoMotors\ModuleAjax\Model\ResourceModel\Fiesta'
        );
    }
}