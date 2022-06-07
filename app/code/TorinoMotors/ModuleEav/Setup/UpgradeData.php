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
        /* Departamento Sales */
        $salesDept = $this->departamentoFactory->create();
        $salesDept->setName('Sales');
        $salesDept->save();
        /* Empleado 1 */
        $empleado1 = $this->empleadoFactory->create();
        $empleado1->setDepartmentId($salesDept->getId());
        $empleado1->setEmail('email_prueba@gmail.com');
        $empleado1->setFirstName('Carlos');
        $empleado1->setLastName('Rocha');
        $empleado1->setServiceYears(3);;
        $empleado1->setSalary(4000.00);
        $empleado1->setVatNumber('5993');
        $empleado1->setNote('Nota referente a Carlos');
        $empleado1->save();
        /* Departamento Finance */
        $financeDep = $this->departamentoFactory->create();+
        $financeDep->setName('Finance');
        $financeDep->save();
        /* Empleado 2 */
        $empleado2 = $this->empleadoFactory->create();
        $empleado2->setDepartmentId($salesDept->getId());
        $empleado2->setEmail('email_prueba2@gmail.com');
        $empleado2->setFirstName('Samuel');
        $empleado2->setLastName('Garcia');
        $empleado2->setServiceYears(4);;
        $empleado2->setSalary(6000.00);
        $empleado2->setVatNumber('7897');
        $empleado2->setNote('Nota referente a Samuel');
        $empleado2->save();

        $setup->endSetup();
    }
} 