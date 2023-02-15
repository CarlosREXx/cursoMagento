<?php

namespace TorinoMotors\Themeoption\Observer;

class HandleSaveProduct implements \Magento\Framework\Event\ObserverInterface{

    /**
     *  @param \Magento\Framework\App\RequestInterface $request
     */
    protected $request;

    /** @param \Magento\Catalog\Model\ProductRepository $productRepository */
    private $productRepository;
    
    public function __construct(\Magento\Framework\App\RequestInterface $request, \Magento\Catalog\Model\ProductRepository $productRepository)
    {
        $this->request = $request;
        $this->productRepository = $productRepository;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
    }
}