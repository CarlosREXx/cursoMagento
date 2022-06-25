<?php

namespace TorinoMotors\ModuleWebApi\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         *  Create table 'torinomotors_slider_slide'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('torinomotors_slider_slide'))
            ->addColumn(
                'slide_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Slide Id'
            )
            ->addColumn(
                'title',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                200,
                [],
                'Title'
            )->setComment('TorinoMotors Slider Slide');
        $installer->getConnection()->createTable($table);

        /**
         *  Create table 'torinomotors_slider_image'
         */
        $table = $installer->getConnection()
                ->newTable($installer->getTable('torinomotors_slider_image'))
                ->addColumn(
                    'image_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'Image Id'
                )
                ->addColumn(
                    'slide_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true, 'nullable' => false],
                    'Slide Id'
                )
                ->addColumn(
                    'path',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    200,
                    [],
                    'Image Path'
                )
                ->addForeignKey(
                    $installer->getFkName('torinomotors_slider_image', 'slide_id', 'torinomotors_slider_slide', 'slide_id'),
                    'slide_id',
                    $installer->getTable('torinomotors_slider_slide'),
                    'slide_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )->setComment('TorinoMotors Slider Image');
            $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}