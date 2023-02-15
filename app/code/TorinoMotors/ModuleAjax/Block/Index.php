<?php

namespace TorinoMotors\ModuleAjax\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use TorinoMotors\ModuleAjax\Service\jServiceAPI;
use TorinoMotors\ModuleAjax\Service\torinoServiceAPI;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Async\CallbackDeferred;
use Magento\Framework\Url\ModifierInterface;
use Phpml\Classification\SVC;
use Phpml\SupportVectorMachine\Kernel;

class Index extends Template
{
    protected $_tserviceApi;

    protected $_callbackDeferred;

    protected $_helper;

    protected $_calculator;

    /**
     * @var \Magento\Catalog\Model\CategoryFactory $categoryFactory
     */
    protected $categoryFactory;

    /**
     * @var \Magento\Catalog\Model\Product $product
     */
    protected $product;

    /** 
     * @var \Magento\Catalog\Model\ProductRepository $productRepository
    */
    protected $productRepository;

    public function __construct(
        torinoServiceAPI $tserviceApi,
        Context $context,
        jServiceAPI $jServiceAPI,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Url\Helper\Data $helper,
        \Magento\Framework\Math\Division $calculator,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Catalog\Model\Product $product,
        \Magento\Catalog\Model\ProductRepository $productRepository
    ){
        $this->_tserviceApi = $tserviceApi;
        $this->_jServiceAPI = $jServiceAPI;
        $this->_storeManager = $storeManager;
        $this->_helper = $helper;
        $this->_calculator = $calculator;
        $this->categoryFactory = $categoryFactory;
        $this->product = $product;
        $this->productRepository = $productRepository;
        parent::__construct($context);    
    }

    public function torinoData(){
        return $this->_tserviceApi->getDataTorino();
    }

    public function motosData($categoryId = null, $categoryId2 = null)
    {
        return $this->_tserviceApi->getDataMotos($categoryId, $categoryId2);
    }

    public function getParamRh()
    {
        $params = $this->getRequest()->getParams();
        if(isset($params['id_rh'])){
            return $params['id_rh'];
        }
        return "";
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    public function AsyncFunction(){
        $deferred = new CallbackDeferred(function(){
            return 'Success Callback Execute';
        });
        $deferred->get();
    }

    public function getDataCollection(){
        $om = \Magento\Framework\App\ObjectManager::getInstance();
        $collectionNames = $om->get('TorinoMotors\ModuleAjax\Model\CustomCollection\CollectionNames');
        $collection = $collectionNames->getCollection(['current' => 2, 'size' => 5]);
        return $collection->toArray();
    }

    public function SVC(){
        $samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
        $labels = ['a', 'a', 'a', 'b', 'b', 'b'];
        $classifier = new SVC(
            Kernel::LINEAR, // $kernel
            1.0,            // $cost
            3,              // $degree
            null,           // $gamma
            0.0,            // $coef0
            0.001,          // $tolerance
            100,            // $cacheSize
            true,           // $shrinking
            true            // $probabilityEstimates, set to true
        );
        $classifier->train($samples, $labels);
        return $classifier->predictProbability([3,2]);
    }

    public function EncodeUrl(){
        return $this->_helper->getCurrentBase64Url();
    }

    public function AddParameters(){
        return $this->_helper->addRequestParam('http://holamundo.com.es', ['id' => 'CARLOS%ROBERTO%ROCHA']);
    }

    public function calculated(){
        return $this->_calculator->getExactDivision(95,7);
    }

    public function getCategory()
    {
        $categoryId = 4;
        $category = $this->categoryFactory->create()->load($categoryId);
        return $category;
    }

    public function getProductCollection()
    {
        $collection = $this->getCategory()->getProductCollection()->addAttributeToFilter('type_id', ['eq' => 'configurable']);
        $data = $collection->getData();
        return $data;
    }

    public function getAditionalData(){
        $array = [];
        $dataCollection = $this->getProductCollection();
        foreach($dataCollection as $key => $data){
            $id = $data['entity_id'];
            if ($data['type_id'] !== 'configurable') {
                $configurableProduct = $this->productRepository->getById($id);
                $ficha = $configurableProduct->getCustomAttribute('ficha_tecnica');
                $array[$key]['name'] = $configurableProduct->getName(); 
            }
        }
        return $array;
    }
}