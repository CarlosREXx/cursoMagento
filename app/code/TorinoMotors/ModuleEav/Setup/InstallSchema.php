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
        $table = $setup->getConnection()
                ->newTable($setup->getTable($empleadoEntity . '_entity_int'))
                ->addColumn(
                    'value_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true, 'nullable'=>false, 'primary'=>true],
                    'Value Id'
                )
                ->addColumn(
                    'attribute_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['unsigned'=>true, 'nullable'=>false, 'default'=>'0'],
                    'Attribute Id'
                )
                ->addColumn(
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['unsigned'=>true, 'nullable'=>false, 'default'=>'0'],
                    'Store_Id'
                )
                ->addColumn(
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['unsigned'=>true, 'nullable'=>false, 'default'=>'0'],
                    'Entity Id'
                )
                ->addColumn(
                    'value',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [],
                    'Value'
                )
                ->addIndex(
                    $setup->getIdxName($empleadoEntity . '_entity_int', ['entity_id', 'attribute_id', 'store_id'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                    ['entity_id', 'attribute_id', 'store_id'],
                    ['type'=>\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addIndex(
                    $setup->getIdxName($empleadoEntity . '_entity_int', ['attribute_id']),
                    ['attribute_id']
                )
                ->addIndex(
                    $setup->getIdxName($empleadoEntity . '_entity_int', ['store_id']),
                    ['store_id']
                )
                ->addForeignKey(
                    $setup->getFkName($empleadoEntity . '_entity_int', 'attribute_id', 'eav_attribute', 'attribute_id'),
                    'attribute_id',
                    $setup->getTable('eav_attribute'),
                    'attribute_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName($empleadoEntity . '_entity_int', 'entity_id', $empleadoEntity . '_entity', 'entity_id'),
                    'entity_id',
                    $setup->getTable($empleadoEntity . '_entity'),
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName($empleadoEntity . '_entity_int', 'store_id', 'store', 'store_id'),
                    'store_id',
                    $setup->getTable('store'),
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->setComment('TorinoMotors Empleados Integer Attribute Backend Table');
        $setup->getConnection()->createTable($table);
        /* _entity_datetime */
        $table = $setup->getConnection()
                ->newTable($setup->getTable($empleadoEntity . '_entity_datetime'))
                ->addColumn(
                    'value_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true, 'nullable'=>false, 'primary'=>true],
                    'Value Id'
                )
                ->addColumn(
                    'attribute_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['unsigned'=>true, 'nullable'=>false, 'default'=>'0'],
                    'Attribute Id'
                )
                ->addColumn(
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['unsigned'=>true, 'nullable'=>false, 'default'=>'0'],
                    'Store_Id'
                )
                ->addColumn(
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['unsigned'=>true, 'nullable'=>false, 'default'=>'0'],
                    'Entity Id'
                )
                ->addColumn(
                    'value',
                    \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                    null,
                    [],
                    'Value'
                )
                ->addIndex(
                    $setup->getIdxName($empleadoEntity . '_entity_datetime', ['entity_id', 'attribute_id', 'store_id'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                    ['entity_id', 'attribute_id', 'store_id'],
                    ['type'=>\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addIndex(
                    $setup->getIdxName($empleadoEntity . '_entity_datetime', ['attribute_id']),
                    ['attribute_id']
                )
                ->addIndex(
                    $setup->getIdxName($empleadoEntity . '_entity_datetime', ['store_id']),
                    ['store_id']
                )
                ->addForeignKey(
                    $setup->getFkName($empleadoEntity . '_entity_datetime', 'attribute_id', 'eav_attribute', 'attribute_id'),
                    'attribute_id',
                    $setup->getTable('eav_attribute'),
                    'attribute_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName($empleadoEntity . '_entity_datetime', 'entity_id', $empleadoEntity . '_entity', 'entity_id'),
                    'entity_id',
                    $setup->getTable($empleadoEntity . '_entity'),
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName($empleadoEntity . '_entity_datetime', 'store_id', 'store', 'store_id'),
                    'store_id',
                    $setup->getTable('store'),
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->setComment('TorinoMotors Empleados Datetime Attribute Backend Table');
        $setup->getConnection()->createTable($table);
        /* _entity_decimal */
        $table = $setup->getConnection()
                ->newTable($setup->getTable($empleadoEntity . '_entity_decimal'))
                ->addColumn(
                    'value_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true, 'nullable'=>false, 'primary'=>true],
                    'Value Id'
                )
                ->addColumn(
                    'attribute_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['unsigned'=>true, 'nullable'=>false, 'default'=>'0'],
                    'Attribute Id'
                )
                ->addColumn(
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['unsigned'=>true, 'nullable'=>false, 'default'=>'0'],
                    'Store_Id'
                )
                ->addColumn(
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['unsigned'=>true, 'nullable'=>false, 'default'=>'0'],
                    'Entity Id'
                )
                ->addColumn(
                    'value',
                    \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    '12,4',
                    [],
                    'Value'
                )
                ->addIndex(
                    $setup->getIdxName($empleadoEntity . '_entity_decimal', ['entity_id', 'attribute_id', 'store_id'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                    ['entity_id', 'attribute_id', 'store_id'],
                    ['type'=>\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addIndex(
                    $setup->getIdxName($empleadoEntity . '_entity_decimal', ['attribute_id']),
                    ['attribute_id']
                )
                ->addIndex(
                    $setup->getIdxName($empleadoEntity . '_entity_decimal', ['store_id']),
                    ['store_id']
                )
                ->addForeignKey(
                    $setup->getFkName($empleadoEntity . '_entity_decimal', 'attribute_id', 'eav_attribute', 'attribute_id'),
                    'attribute_id',
                    $setup->getTable('eav_attribute'),
                    'attribute_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName($empleadoEntity . '_entity_decimal', 'entity_id', $empleadoEntity . '_entity', 'entity_id'),
                    'entity_id',
                    $setup->getTable($empleadoEntity . '_entity'),
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName($empleadoEntity . '_entity_decimal', 'store_id', 'store', 'store_id'),
                    'store_id',
                    $setup->getTable('store'),
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->setComment('TorinoMotors Empleados Decimal Attribute Backend Table');
        $setup->getConnection()->createTable($table);
        /* _entity_varchar */
        $table = $setup->getConnection()
                ->newTable($setup->getTable($empleadoEntity . '_entity_varchar'))
                ->addColumn(
                    'value_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true, 'nullable'=>false, 'primary'=>true],
                    'Value Id'
                )
                ->addColumn(
                    'attribute_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['unsigned'=>true, 'nullable'=>false, 'default'=>'0'],
                    'Attribute Id'
                )
                ->addColumn(
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['unsigned'=>true, 'nullable'=>false, 'default'=>'0'],
                    'Store_Id'
                )
                ->addColumn(
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['unsigned'=>true, 'nullable'=>false, 'default'=>'0'],
                    'Entity Id'
                )
                ->addColumn(
                    'value',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Value'
                )
                ->addIndex(
                    $setup->getIdxName($empleadoEntity . '_entity_varchar', ['entity_id', 'attribute_id', 'store_id'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                    ['entity_id', 'attribute_id', 'store_id'],
                    ['type'=>\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addIndex(
                    $setup->getIdxName($empleadoEntity . '_entity_varchar', ['attribute_id']),
                    ['attribute_id']
                )
                ->addIndex(
                    $setup->getIdxName($empleadoEntity . '_entity_varchar', ['store_id']),
                    ['store_id']
                )
                ->addForeignKey(
                    $setup->getFkName($empleadoEntity . '_entity_varchar', 'attribute_id', 'eav_attribute', 'attribute_id'),
                    'attribute_id',
                    $setup->getTable('eav_attribute'),
                    'attribute_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName($empleadoEntity . '_entity_varchar', 'entity_id', $empleadoEntity . '_entity', 'entity_id'),
                    'entity_id',
                    $setup->getTable($empleadoEntity . '_entity'),
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName($empleadoEntity . '_entity_varchar', 'store_id', 'store', 'store_id'),
                    'store_id',
                    $setup->getTable('store'),
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->setComment('TorinoMotors Empleados Varchar Attribute Backend Table');
        $setup->getConnection()->createTable($table);
        /* _entity_text */
        $table = $setup->getConnection()
                ->newTable($setup->getTable($empleadoEntity . '_entity_text'))
                ->addColumn(
                    'value_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true, 'nullable'=>false, 'primary'=>true],
                    'Value Id'
                )
                ->addColumn(
                    'attribute_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['unsigned'=>true, 'nullable'=>false, 'default'=>'0'],
                    'Attribute Id'
                )
                ->addColumn(
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['unsigned'=>true, 'nullable'=>false, 'default'=>'0'],
                    'Store_Id'
                )
                ->addColumn(
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['unsigned'=>true, 'nullable'=>false, 'default'=>'0'],
                    'Entity Id'
                )
                ->addColumn(
                    'value',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [],
                    'Value'
                )
                ->addIndex(
                    $setup->getIdxName($empleadoEntity . '_entity_text', ['entity_id', 'attribute_id', 'store_id'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                    ['entity_id', 'attribute_id', 'store_id'],
                    ['type'=>\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addIndex(
                    $setup->getIdxName($empleadoEntity . '_entity_text', ['attribute_id']),
                    ['attribute_id']
                )
                ->addIndex(
                    $setup->getIdxName($empleadoEntity . '_entity_text', ['store_id']),
                    ['store_id']
                )
                ->addForeignKey(
                    $setup->getFkName($empleadoEntity . '_entity_text', 'attribute_id', 'eav_attribute', 'attribute_id'),
                    'attribute_id',
                    $setup->getTable('eav_attribute'),
                    'attribute_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName($empleadoEntity . '_entity_text', 'entity_id', $empleadoEntity . '_entity', 'entity_id'),
                    'entity_id',
                    $setup->getTable($empleadoEntity . '_entity'),
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName($empleadoEntity . '_entity_text', 'store_id', 'store', 'store_id'),
                    'store_id',
                    $setup->getTable('store'),
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->setComment('TorinoMotors Empleados Text Attribute Backend Table');
        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}