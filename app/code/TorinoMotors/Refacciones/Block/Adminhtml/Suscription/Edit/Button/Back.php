<?php

namespace TorinoMotors\Refacciones\Block\Adminhtml\Suscription\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;

class Back extends Generic implements ButtonProviderInterface
{
    /**
     * Get Button data
     * 
     * @return array
     */
    public function getButtonData()
    {
        $backUrl = $this->getBackUrl();
        return [
            "label" => __("Back"),
            "on_click" => sprintf("location_href = '$backUrl'"),
            "class" => "back",
            "sort_order" => 10,
        ];
    }

    /**
     * Get URL forback (reset) button
     */
    public function getBackUrl()
    {
        return $this->getUrl("*/*/");
    }
}