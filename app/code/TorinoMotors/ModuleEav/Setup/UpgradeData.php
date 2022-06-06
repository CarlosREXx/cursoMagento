<?php 
 
namespace TorinoMotors\ModuleEav\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    protected $departamentoFactory;
    protected $empleadoFactory;

    public function __construct(
        \TorinoMotors\ModuleEav\Model\DepartamentoFactory $departamentoFactory,
        \TorinoMotors\ModuleEav\Model\EmpleadoFactory $empleadoFactory
    )
    {
        $this->departamentoFactory = $departamentoFactory;
        $this->empleadoFactory = $empleadoFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $salesDept = $this->departamentoFactory->create();

        $setup->endSetup();
    }
} 