<?php 

namespace TorinoMotors\ModuleWebApi\Model\ResourceModel\Slide;

/**
 * TorinoMotors Slice collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model an model
     * 
     * @return void
     */
    protected function _construct()
    {
        /**_init($model, $resourceModel) */
        $this->_init('TorinoMotors\ModuleWebApi\Model\Slide', 'TorinoMotors\ModuleWebApi\Model\ResourceModel\Slide');
    }
}