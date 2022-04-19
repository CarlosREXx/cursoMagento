<?php

namespace TorinoMotors\Refacciones\Block\Adminhtml\Suscription;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var  \TorinoMotors\Refacciones\Model\Resource\Suscription\Collection
     */

     protected $_suscriptionCollection;

     /**
      * @param \Magento\Backend\Block\Template\Context $context
      * @param \Magento\Backend\Helper\Data $backendHelper
      * @param \TorinoMotors\Refacciones\Model\ResourceModel\Suscription\Collection $suscriptionCollection
      * @param array $data
      */

      public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        // \TorinoMotors\Refacciones\Model\ResourceModel\Suscription\Collection $suscriptionCollection,
        array $data = []
      ){
        //   $this->_suscriptionCollection = $suscriptionCollection;
          parent::__construct($context, $backendHelper, $data);
          $this->setEmptyText(__("No Subscription Found"));
      }

      /**
       * Initialize the suscription collection
       * 
       * @return WidgetGrid
       */

    //    protected function _prepareCollection(){
    //        $this->setCollection($this->_suscriptionCollection);
    //        return parent::_prepareCollection();
    //    }

}