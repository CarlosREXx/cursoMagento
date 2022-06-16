<?php

namespace TorinoMotors\ModuleEav\Model\ResourceModel;

class Empleado extends \Magento\Eav\Model\Entity\AbstractEntity
{
    protected function _construct()
    {
        $this->_read = 'torinomotors_empleados_read';
        $this->_write = 'torinomotors_empleados_write';
    }

    public function getEntityType()
    {
        if(empty($this->_type)){
            $this->setType(\TorinoMotors\ModuleEav\Model\Empleado::ENTITY);
        }
        return parent::getEntityType();
    }
}