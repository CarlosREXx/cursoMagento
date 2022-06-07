<?php

namespace TorinoMotors\ModuleEav\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        /* Script Tables */
        /* Table Departamento */
        $table = $setup->getConnection()
                ->newTable($setup->getTable('torinomotors_departamento'))
                ->addColumn(
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true, 'unsigned'=>true, 'nullable' => false, 'primary'=>true],
                    'Entity Id'
                )
                ->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    64,
                    [],
                    'Name'
                    )
                ->setComment('Tabla de Departamentos de Area');
        $setup->getConnection()->createTable($table);
        /* Tables Empleado Entity */
        /* _entity */
        $empleadoEntity = \TorinoMotors\ModuleEav\Model\Empleado::ENTITY;
        $table = $setup->getConnection()
                    ->newTable($setup->getTable($empleadoEntity . '_entity'))
                    ->addColumn(
                        'entity_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        ['identity'=>true, 'unsigned'=>true, 'nullable'=>false, 'primary'=>true],
                        'Entity Id'
                    )
                    ->addColumn(
                        'department_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        ['unsigned'=>true, 'nullable'=>false],
                        'Departamento Id'
                    )
                    ->addColumn(
                        'email',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        64,
                        [],
                        'Email'
                    )
                    ->addColumn(
                        'first_name',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        64,
                        [],
                        'First Name'
                    )
                    ->addColumn(
                        'last_name',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        64,
                        [],
                        'Last Name'
                    )
                    ->setComment('TorinoMotors Departamento Table Base Entity');
        $setup->getConnection()->createTable($table);
        /* _entity_int */
        /* _entity_datetime */
        /* _entity_decimal */
        /* _entity_varchar */
        /* _entity_text */

        $setup->endSetup();
    }
}