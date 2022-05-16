<?php

namespace TorinoMotors\ModuleAjax\Controller\Adminhtml\Marcas;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use TorinoMotors\ModuleAjax\Model\ResourceModel\Marcas\CollectionFactory;
//use TorinoMotors\ModuleAjax\Ui\Component\Listing\DataProvider;

class Lugares extends Action
{
    protected $resultPageFactory;

    public function __construct(
        PageFactory $pageFactory,
        Context $context,
        CollectionFactory $collectionFactory
        //DataProvider $collectionFilter
    ){
        $this->collectionFactory = $collectionFactory;
        //$this->collectionFilter = $collectionFilter;
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute(){
        $pageFactory = $this->pageFactory->create();
        $pageFactory->getConfig()->getTitle()->prepend(__("Lugares"));
        // $pageFactory->getLayout()
        // ->getBlock('torinomotors.data.filter.marcas')
        // ->setData('dataCollection', $this->filterCollection());
        //print_r($this->getRequest()->getParam("marca_id"));

        return $pageFactory;
    }

//     public function filterCollection(){
//         $marca = $this->getRequest()->getParam("marca_id");
//         $collection = $this->collectionFactory->create()->addFieldToFilter("marca_id", $marca)->getData();
//         return $collection;
//     }
}