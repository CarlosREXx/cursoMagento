<?php 

namespace TorinoMotors\ModuleWebApi\Model\ResourceModel\Image;

/**
 * TorinoMotors Image collection
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
        $this->_init('TorinoMotors\ModuleWebApi\Model\Image', 'TorinoMotors\ModuleWebApi\Model\ResourceModel\Image');
    }
}