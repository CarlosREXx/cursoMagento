<?php

namespace TorinoMotors\ModuleAjax\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use TorinoMotors\ModuleAjax\Service\jServiceAPI;

class UpgradeData implements UpgradeDataInterface
{   
    const LIST = [
        1 => "Aguascalientes",
        2 => "Baja California",
        3 => "Baja California Sur",
        4 => "Campeche",
        5 => "Chiapas",
        6 => "Chihuahua",
        7 => "Ciudad de México",
        8 => "Coahuila",
        9 => "Colima",
        10 => "Durango",
        11 => "Guanajuato",
        12 => "Guerrero",
        13 => "Hidalgo",
        14 => "Jalisco",
        15 => "Estado de México",
        16 => "Michoacán",
        17 => "Morelos",
        18 => "Nayarit",
        19 => "Nuevo León",
        20 => "Oaxaca",
        21 => "Puebla",
        22 => "Querétaro",
        23 => "Qintana Roo",
        24 => "San Luis Potosí",
        25 => "Sinaloa",
        26 => "Sonora",
        27 => "Tabasco",
        28 => "Tamaulipas",
        29 => "Tlaxcala",
        30 => "Veracruz",
        31 => "Yucatán",
        32 => "Zacatecas"
    ];
    public function __construct(jServiceAPI $jServiceAPI)
    {
        $this->_jServiceApi = $jServiceAPI;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if(version_compare($context->getVersion(), "1.0.1") < 0){
            $data = $this->_jServiceApi->execute(true);
            $estados = self::LIST;
            foreach ($data as $row => $value) {
                $array = [];
                $estado = [];
                    for($i=1; $i<=8; $i++){
                        $aleatorio= rand(1,32);
                        if (in_array($aleatorio, $array)){
                            $i--;
                        }
                        else{
                            $array[] = $aleatorio; 
                            array_push($estado, $estados[$aleatorio]);
                        }
                    }
                $estadosJson = json_encode($estado);
                $bind = [
                    "marca_name" => $value["Nombre"],
                    "presencia" => $estadosJson
                ];
                $setup->getConnection()->insert(
                    $setup->getTable('torinomotors_presenciaen'),
                    $bind
                );
            }
        }
    }
}