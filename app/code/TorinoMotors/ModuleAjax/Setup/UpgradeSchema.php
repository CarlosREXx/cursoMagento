<?php

namespace TorinoMotors\ModuleAjax\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function Upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if(version_compare($context->getVersion(), "1.0.1") < 0){
            $installer = $setup;

            $installer->startSetup();
            $connection = $installer->getConnection();

            // Install new table
            $table = $installer->getConnection()->newTable(
                $installer->getTable("torinmotors_presenciaen")
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
                $installer->getIdxName("torinmotors_presenciaen", ["marca_name"]),
                ["marca_name"]
            )->setComment(
                "Table Presencia en"
            );

            $installer->getConnection()->createTable($table);

            $installer->endSetup();
        }
    }
}