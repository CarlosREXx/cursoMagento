<?php 

namespace TorinoMotors\ModuleEav\Model\ResourceModel\Departamento;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'TorinoMotors\ModuleEav\Model\Departamento',
            'TorinoMotors\ModuleEav\Model\ResourceModel\Departamento'
        );
    }
}