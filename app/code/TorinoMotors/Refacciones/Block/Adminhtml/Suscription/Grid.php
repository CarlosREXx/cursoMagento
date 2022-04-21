<?php

namespace TorinoMotors\Refacciones\Block\Adminhtml\Suscription;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;
use TorinoMotors\Refacciones\Model\ResourceModel\Suscription\Collection;

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
        \TorinoMotors\Refacciones\Model\ResourceModel\Suscription\Collection  $suscriptionCollection,
        array $data = []
      ){
          $this->_suscriptionCollection = $suscriptionCollection;
          parent::__construct($context, $backendHelper, $data);
          $this->setEmptyText(__("No Subscription Found"));
      }

      /**
       * Initialize the suscription collection
       * 
       * @return WidgetGrid
       */

       protected function _prepareCollection(){
           $this->setCollection($this->_suscriptionCollection);
           return parent::_prepareCollection();
       }

       protected function _prepareColumns()
       {
          $this->addColumn(
            "suscription_id",
            [
              "header" => __("ID"),
              "index" => "suscription_id",
            ]
            );
          $this->addColumn(
            "firstname",
            [
              "header" => __("FIRSTNAME"),
              "index" => "firstname",
            ]
            );
          $this->addColumn(
            "lastname",
            [
              "header" => __("LASTNAME"),
              "index" => "lastname",
            ]
            );
          $this->addColumn(
            "email",
            [
              "header" => __("EMAIL"),
              "index" => "email",
            ]
            );
          $this->addColumn(
            "status",
            [
              "header" => __("Status"),
              "index" => "status",
              "frame_callback" => [$this, "decorateStatus"]
            ]
            );
          
            return $this;
       }

       public function decorateStatus($value)
       {
          $class = "";
          switch($value)
          {
            case "pending":
              $class = "grid-severity-minor";
              break;
            case "approved":
              $class = "grid-severity-noltice";
              break;
            case "declined":
            default:
              $class = "grid-severity-critical";
              break;
          }
          return "<span class='".$class."'><span>".$value."</span></span>";
       }

}