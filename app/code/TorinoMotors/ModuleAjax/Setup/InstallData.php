<?php

namespace TorinoMotors\ModuleAjax\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use TorinoMotors\ModuleAjax\Service\jServiceAPI;

class InstallData implements InstallDataInterface
{   
    public function __construct(jServiceAPI $jServiceAPI)
    {
        $this->_jServiceApi = $jServiceAPI;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
 
        $data = $this->_jServiceApi->execute(true);
        foreach ($data as $row => $value) {
            $bind = [
                "marca_name" => $value["Nombre"],
                "presencia_en" => "Puebla"
            ];
            $setup->getConnection()->insert(
                $setup->getTable('torinomotors_presenciaen'),
                $bind
            );
        }
    }
}