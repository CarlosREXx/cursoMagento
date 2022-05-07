<?php
namespace TorinoMotors\ModuleAjax\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

            $table = $installer->getConnection()
                ->newTable($installer->getTable('torinomotors_presenciaen'))
                ->addColumn(
                    'marca_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'Id'
                )->addColumn(
                    'marca_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Presencia En'
                )->addColumn(
                    'presencia_en',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    "64k",
                    ['nullable' => false],
                    'Presencia En'
                )->addColumn(
					'created_at',
					\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
					null,
					['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
					'Created At'
				)->addColumn(
					'updated_at',
					\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
					null,
					['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
					'Updated At'
                )->addIndex(
                    $installer->getIdxName("torinomotors_presenciaen",
                    ["marca_name"], 
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                ["marca_name"], 
                ["type" => AdapterInterface::INDEX_TYPE_FULLTEXT]
                )->setComment("Presencia Table");
            $installer->getConnection()->createTable($table);
            $installer->endSetup(); 
    }
}