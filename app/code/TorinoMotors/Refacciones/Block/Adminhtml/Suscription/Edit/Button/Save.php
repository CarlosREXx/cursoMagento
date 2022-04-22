<?php

namespace TorinoMotors\Refacciones\Block\Adminhtml\Suscription\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;
use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;

class Save extends Generic implements ButtonProviderInterface
{
    /**
     * Get button data
     * 
     * @return array
     */
    public function getButtonData()
    {
        return [
            "label" => __("Guardar"),
            "class" => "save primary",
            "data_attribute" => [
                "mage-init" => [
                    "buttonAdapter" => [
                        "actions" => [
                            [
                                "targetName" => "refacciones_form.refacciones_form",
                                "actionName" => "save",
                                "params" => [false],
                            ],
                        ],
                    ],
                ],
            ],
            "class_name" => Container::SPLIT_BUTTON,
            "options" => $this->getOptions(),
        ];
    }

    /**
     * Retrive options
     * 
     * @return array
     */
    protected function getOptions()
    {
        $options[] = [
            "id_hard" => "save_and_new",
            "label" => __("Guardar Nuevo"),
            "data_attribute" => [
                "mage-init" => [
                    "buttonAdapter" => [
                        "actions" => [
                            [
                                "targetName" => "refacciones_form.refacciones_form",
                                "actionName" => "save",
                                "params" => [
                                    true, [
                                        "back" => "add",
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $options[] = [
            "id_hard" => "save_and_close",
            "label" => __("Guardar y Cerrar"),
            "data_attribute" => [
                "mage-init" => [
                    "buttonAdapter" => [
                        "actions" => [
                            [
                                "targetName" => "refacciones_form.refacciones_form",
                                "actionName" => "save",
                                "params" => [true],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        return $options;
    }
}