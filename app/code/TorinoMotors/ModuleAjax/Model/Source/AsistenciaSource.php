<?php

namespace TorinoMotors\ModuleAjax\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

class AsistenciaSource extends AbstractSource implements SourceInterface, OptionSourceInterface
{
    const NO_ASSIST = 0;
    const CORRECT_ASSIST = 1;

    public static function getOptionArray()
    {
        return [
            self::NO_ASSIST => __('Sin Asistir'),
            self::CORRECT_ASSIST => __('Asistio'),
        ];
    }

    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }
}