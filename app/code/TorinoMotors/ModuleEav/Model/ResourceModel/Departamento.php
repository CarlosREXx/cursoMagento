<?php

namespace TorinoMotors\ModuleEav\Model\ResourceModel;

class Departamento extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init("torinomotors_departamento", "entity_id");
    }
}