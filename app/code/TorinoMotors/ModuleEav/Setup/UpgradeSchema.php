<?php

namespace TorinoMotors\ModuleEav\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        /* Entity Empleado */
        $empleadoEntity = \TorinoMotors\ModuleEav\Model\Empleado::ENTITY . '_entity';
        $departamentoTable = "torinomotors_departamento";

        $setup->getConnection()
            ->addForeignKey(
                $setup->getFkName($empleadoEntity, 'department_id', $departamentoTable, 'entity_id'),
                $setup->getTable($empleadoEntity),
                'department_id',
                $setup->getTable($departamentoTable),
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );
        $setup->endSetup();
    } 
}