<?php

namespace TorinoMotors\ModuleSchema\Model;

class CustomTable extends \Magento\Framework\Model\AbstractModel
{
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resouce = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ){
        parent::__construct($context, $registry, $resouce, $resourceCollection, $data);        
    }

    public function _construct(){
        $this->_init("TorinoMotors\ModuleSchema\Module\ResourceModel\CustomTable");
    }
}