<?php

namespace TorinoMotors\ModuleAjax\Model\ResourceModel;


class Marcas extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ){
        parent::__construct($context);
    }
    protected function _construct()
    {
        $this->_init("torinomotors_marcas", "marca_id");
    }
}