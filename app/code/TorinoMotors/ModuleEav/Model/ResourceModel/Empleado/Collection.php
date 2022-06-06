<?php 
namespace TorinoMotors\ModuleEav\Model\ResourceModel\Empleado;

class Collection extends \Magento\Eav\Model\Entity\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'TorinoMotors\ModuleEav\Model\Empleado',
            'TorinoMotors\ModuleEav\Model\ResourceModel\Empleado'
        );
    }
}