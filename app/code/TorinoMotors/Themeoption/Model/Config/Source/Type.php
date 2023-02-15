<?php
namespace TorinoMotors\Themeoption\Model\Config\Source;
class Type extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $_options;

    /**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [
                ['value' => '1', 'label' => __('Type-1')],
                ['value' => '2', 'label' => __('Type-2')],
                ['value' => '3', 'label' => __('Type-3')],
                ['value' => '4', 'label' => __('Type-4')],
                ['value' => '5', 'label' => __('Type-5')],
                ['value' => '6', 'label' => __('Type-6')],
                ['value' => '7', 'label' => __('Type-7')],
                ['value' => '8', 'label' => __('Type-8')],
                ['value' => '9', 'label' => __('Type-9')],
                ['value' => '10', 'label' => __('Type-10')]
            ];
        }
        return $this->_options;
    }
    final public function toOptionArray()
    {
       return array(
        array('value' => '1', 'label' => __('Type-1')),
        array('value' => '2', 'label' => __('Type-2')),
        array('value' => '3', 'label' => __('Type-3')),
        array('value' => '4', 'label' => __('Type-4')),
        array('value' => '5', 'label' => __('Type-5')),
        array('value' => '6', 'label' => __('Type-6')),
        array('value' => '7', 'label' => __('Type-7')),
        array('value' => '8', 'label' => __('Type-8')),
        array('value' => '9', 'label' => __('Type-9')),
        array('value' => '10', 'label' => __('Type-10')),
    );
   }
}