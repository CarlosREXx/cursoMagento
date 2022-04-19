<?php

namespace TorinoMotors\Refacciones\Block;

use Magento\Framework\View\Element\Template;

class Motores extends Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ){
        parent::__construct($context, $data);
    }
}