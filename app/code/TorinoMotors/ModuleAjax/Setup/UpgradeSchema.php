<?php

namespace TorinoMotors\ModuleAjax\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function Upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $connection = $installer->getConnection();
        if(version_compare($context->getVersion(), "1.0.1") < 0){
            // Install new table
            $table = $installer->getConnection()->newTable(
                $installer->getTable("torinomotors_presenciaen")
            )->addColumn(
                "marca_id",
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    "identity" => true,
                    "unsigned" => true,
                    "nullable" => false,
                    "primary" => true
                ],
                "Marca Id"
            )->addColumn(
                "created_at",
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                [
                    "nullable" => false,
                    "default" => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
                ],
                "Created at"
            )->addColumn(
                "update_at",
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                [],
                "Update at"
            )->addColumn(
                "marca_name",
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ["nullable" => false],
                "Marca"
            )->addColumn(
                "presencia",
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                "64k",
                ["nullable" => false],
                "Presencia en"
            )->addIndex(
                $installer->getIdxName("torinomotors_presenciaen", ["marca_name"]),
                ["marca_name"]
            )->setComment(
                "Table Presencia en"
            );

            $installer->getConnection()->createTable($table);

        }

        if(version_compare($context->getVersion(), "1.0.2") < 0){
            if (!$installer->tableExists('torinomotors_marcas_complete')){
                $table = $installer->getConnection()->newTable(
                    $installer->getTable("torinomotors_marcas_complete")
                )->addColumn(
                    "marca_id",
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        "identity" => true,
                        "unsigned" => true,
                        "nullable" => false,
                        "primary" => true
                    ],
                    "Marca Id"
                )->addColumn(
                    "created_at",
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [
                        "nullable" => false,
                        "default" => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
                    ],
                    "Created at"
                )->addColumn(
                    "update_at",
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    "Update at"
                )->addColumn(
                    "marca_name",
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ["nullable" => false],
                    "Marca"
                )->addColumn(
                    "imagen",
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    "64k",
                    ["nullable" => true],
                    "Marca"
                )->addColumn(
                    "dealer",
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    "64k",
                    ["nullable" => true],
                    "Distribuidora"
                )->addIndex(
                    $installer->getIdxName("torinomotors_marcas_complete", ["marca_name"]),
                    ["marca_name"]
                )->setComment(
                    "Table Marcas"
                );
    
                $installer->getConnection()->createTable($table);
            }
        }

        if(version_compare($context->getVersion(), "1.0.2") < 0){
            if (!$installer->tableExists('torinomotors_marcas_distribuidoralugares')){
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('torinomotors_marcas_distribuidoralugares')
                );
                $table->addColumn(
                    'dealer_place_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Distribuidora id'
                )->addColumn(
                    'marca_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false, 'unsigned' => true],
                    'Marca Id'
                )->addColumn(
                    'dealer_place',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Lugar de Distribuidora'
                )->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false],
                    'Created At'
                )->addForeignKey(
                    $installer->getFkName(
                        'torinomotors_marcas_distribuidoralugares',
                        'marca_id',
                        'torinomotors_marcas_complete',
                        'marca_id'
                    ),
                    'marca_id',
                    $installer->getTable('torinomotors_marcas_complete'),
                    'marca_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )->setComment('Lugares de Distribuidoras');
                $installer->getConnection()->createTable($table);
            }
        }

        $installer->endSetup();
    }
}