<?php

namespace  TorinoMotors\ModuleAjax\Block\Adminhtml\Marcas;

class Lugares extends \Magento\Backend\Block\Widget\Grid\Extended
{
    protected $productFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \TorinoMotors\ModuleAjax\Model\ResourceModel\Distribuidoras\CollectionFactory $collectionFactory,
        \Magento\Framework\Registry $coreRegistry,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('hello_tab_grid');
        $this->setDefaultSort('entity_id');
        $this->setUseAjax(true);
    }

    /**
     * @return Grid
     */
    protected function _prepareCollection()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();  
        $request = $objectManager->get('Magento\Framework\App\Request\Http');  
        $param = $request->getParam('marca_id');
        $collection = $this->collectionFactory->create()->addFieldToFilter("marca_id", $param);
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return Extended
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'dealer_place_id',
            [
                'header' => __('Dealer Place Id'),
                'sortable' => true,
                'index' => 'entity_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );
        $this->addColumn(
            'marca_id',
            [
                'header' => __('Marca Id'),
                'index' => 'marca_id'
            ]
        );
        $this->addColumn(
            'dealer_place',
            [
                'header' => __('Dealer Place'),
                'index' => 'dealer'
            ]
        );

        return parent::_prepareColumns();
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('hello/*/helloGrid', ['_current' => true]);
    }

}