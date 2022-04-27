<?php

namespace TorinoMotors\ModuleSchema\Model\ResourceModel\CustomTable;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct(){
        $this->_init("TorinoMotors\ModuleSchema\Module\CustomTable", "TorinoMotors\ModuleSchema\Module\ResourceModel\CustomTable");
    }
} 