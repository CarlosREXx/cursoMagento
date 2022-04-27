<?php

namespace TorinoMotors\ModuleSchema\Setup;

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

        /**
         * addColumn(
            * name,
            * size,
            * option[unsigned, scale, nullable, primary, primary_position, identity/auto_increment, comment]
         * );
         * addForeingKey(
         *      fkName, column, refTable, refColumn, onDelete[ACTION_CASCADE, ACTION_RESTRICT, ACTION_SET_DEFAULT, ACTION_SET_NULL, ACTION_NO_ACTION]
         * );
         * addIndex( indexName, fields, options )
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable("torinomotors_customtable")
        )->addColumn(
            "entity_id",
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ["identity"=>true, "nullable"=>false, "primary"=>true],
            "Entity ID" 
        )->addColumn(
            "nombre",
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            40,
            ["nullable"=>true],
            "Nombre Personal"
        )->addColumn(
            "fecha_registro",
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [],
            "Fecha de registro"
        )->addColumn(
            "estatus",
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ["nullable" => true, "default" => 1],
            "Estatus"
        )->addIndex(
            $installer->getIdxName("torinomotors_customtable",
            ["nombre"],
            AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
        ["nombre"],
        ["type" => AdapterInterface::INDEX_TYPE_FULLTEXT]
        )->setComment("Comentario Tabla");
        $installer->getConnection()->createTable($table);
        $installer->endSetup();

        /**
         * type column
         * 
         * TYPE_BOOLEAN
         * TYPE_SAMLLINT
         * TYPE_INTEGER
         * TYPE_BIGIN
         * TYPE_FLOAT
         * TYPE_NUMERIC
         * TYPE_DECIMAL
         * TYPE_DATE
         * TYPE_TIMESTAMP
         * TYPE_DATETIME
         * TYPE_TEXT
         * TYPE_BLOB
         * TYPE_VARBINARY
         */
    }
}