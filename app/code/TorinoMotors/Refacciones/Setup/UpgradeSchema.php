<?php

namespace TorinoMotors\Refacciones\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function Upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if(version_compare($context->getVersion(), "2.0.1") < 0){
            $installer = $setup;

            $installer->startSetup();
            $connection = $installer->getConnection();

            // Install new table
            $table = $installer->getConnection()->newTable(
                $installer->getTable("motors_suscription")
            )->addColumn(
                "suscription_id",
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    "identity" => true,
                    "unsigned" => true,
                    "nullable" => false,
                    "primary" => true
                ],
                "Suscription Id"
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
                "firstname",
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                64,
                ["nullable" => false],
                "First Name"
            )->addColumn(
                "lastname",
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                64,
                ["nullable" => false],
                "Last Name"
            )->addColumn(
                "email",
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ["nullable" => false],
                "Email Address"
            )->addColumn(
                "status",
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [
                    "nullable" => false,
                    "default" => "pending"
                ],
                "Status"
            )->addColumn(
                "message",
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                "64k",
                [
                    "unsigned" => true,
                    "nullable" => false
                ],
                "Suscription Notes"
            )->addIndex(
                $installer->getIdxName("motors_suscription", ["email"]),
                ["email"]
            )->setComment(
                "Table Suscription"
            );

            $installer->getConnection()->createTable($table);

            $installer->endSetup();
        }
    }
}