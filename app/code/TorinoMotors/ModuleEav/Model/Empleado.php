<?php

namespace TorinoMotors\ModuleEav\Model;


class Empleado extends \Magento\Framework\Model\AbstractModel
{
    const ENTITY = 'torinomotors_empleados';

    protected function _construct()
    {
        $this->_init('TorinoMotors\ModuleEav\Model\ResourceModel\Empleado');
    }
}