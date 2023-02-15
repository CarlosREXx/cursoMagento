<?php

namespace TorinoMotors\ModuleAjax\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

use function PHPUnit\Framework\returnSelf;

class Gracias extends Template implements BlockInterface
{
    protected $_template = "widget/gracias_cotiza.phtml";

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        //\Magento\Framework\App\Request\Http $request,
        array $data = []
    ){
        parent::__construct($context, $data);
        //$this->_request = $request;
        $this->_jsonHelper = $jsonHelper;
    }
}