<?php

namespace TorinoMotors\ModuleEav\Setup;

use Magento\Eav\Setup\EavSetup;

class EmpleadoSetup extends EavSetup
{
    public function getDefaultEntities()
    {
        $empleadoEntity = \TorinoMotors\ModuleEav\Model\Empleado::ENTITY;

        $entities = [
            $empleadoEntity => [
                'entity_model' => 'TorinoMotors\ModuleEav\Model\ResourceModel\Empleado',
                'table' => $empleadoEntity . '_entity',
                'attributes' => [
                    'department_id' => [
                        'type' => 'static',
                    ],
                    'email' => [
                        'type' => 'static',
                    ],
                    'first_name' => [
                        'type' => 'static',
                    ],
                    'last_name' => [
                        'type' => 'static',
                    ],
                ],
            ],
        ];
        return $entities;
    } 
}