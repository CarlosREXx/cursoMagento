<?php

namespace TorinoMotors\ModuleAjax\Model\ResourceModel\Marcas;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'TorinoMotors\ModuleAjax\Model\Marcas', 
            'TorinoMotors\ModuleAjax\Model\ResourceModel\Marcas'
        );
    }
}