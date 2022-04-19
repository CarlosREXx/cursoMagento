<?php

namespace TorinoMotors\Refacciones\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Suscription extends Container
{
    protected function _construct()
    {
        $this->_controller = "adminhtml_suscription";
        $this->_blockGroup = "TorinoMotors_Refacciones";
        $this->_headerText = __('Elemnto Marco');
        $this->_addButtonLabel = __('Add News');
        parent::_construct();
    }
}