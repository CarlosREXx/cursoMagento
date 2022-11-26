<?php

namespace TorinoMotors\ModuleAjax\Model\ResourceModel;


class Fiesta extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ){
        parent::__construct($context);
    }
    protected function _construct()
    {
        $this->_init("fiesta_gam_table", "id");
    }
}