<?php

namespace TorinoMotors\ModuleEav\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $empleadoSetupFactory;

    public function __construct(
        TorinoMotors\ModuleEav\Setup\EmpleadoSetupFactory $empleadoSetupFactory
    )
    {
        $this->empleadoSetupFactory = $empleadoSetupFactory;     
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $empleadoEntity = \TorinoMotors\ModuleEav\Model\Empleado::ENTITY;
        $empleadoSetup = $this->empleadoSetupFactory->create(['setup'=>$setup]);
        $empleadoSetup->installEntities();
        $empleadoSetup->addAttribute(
            $empleadoEntity, 'service_years', ['type'=>'int']
        );
        $empleadoSetup->addAttribute(
            $empleadoEntity, 'dob', ['type'=>'datetime']
        );
        $empleadoSetup->addAttribute(
            $empleadoEntity, 'salary', ['type'=>'decimal']
        );
        $empleadoSetup->addAttribute(
            $empleadoEntity, 'vat_number', ['type'=>'varchar']
        );
        $empleadoSetup->addAttribute(
            $empleadoEntity, 'note', ['type'=>'tetx']
        );
        $setup->endSetup();
    }
}