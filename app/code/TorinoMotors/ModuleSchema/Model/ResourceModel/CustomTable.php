<?php

namespace TorinoMotors\ModuleSchema\Model\ResourceModel;

class CustomTable extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init("torinomotors_customtable", "entity_id");
    }
}