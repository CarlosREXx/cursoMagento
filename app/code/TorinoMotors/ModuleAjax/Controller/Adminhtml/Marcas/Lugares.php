<?php

namespace TorinoMotors\ModuleAjax\Controller\Adminhtml\Marcas;

class Lugares extends \Magento\Backend\App\Action
// {
//     /**
//      * @var \Magento\Framework\View\Result\LayoutFactory
//      */
//     protected $resultLayoutFactory;

//     public function __construct(
//         \Magento\Backend\App\Action\Context $context
//     ) {
//         parent::__construct($context);
//     }

//     /**
//      * @return \Magento\Framework\View\Result\Layout
//      */
//     public function execute()
//     {
//         $this->_view->loadLayout();
//         $this->getResponse()->setBody(
//             $this->_view->getLayout()->createBlock('TorinoMotors\ModuleAjax\Block\Adminhtml\Marcas\Lugares')->toHtml());
//     }
// }
{
	const TYPE_IDENTIFIER = 'torinomotors_params_url';
    const CACHE_TAG = 'TORINOMOTORS_MODULEAJAX_MARCAS_TYPE_TAG';

	/** @var \Magento\Framework\Serialize\SerializerInterface $serializer */
	protected $serializer;

	/** @var \Magento\Framework\App\CacheInterface $cache  */
	protected $cache;

	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Framework\App\CacheInterface $cache,
        \Magento\Framework\Serialize\SerializerInterface $serializer
	)
	{
		parent::__construct($context);
		$this->cache = $cache;
		$this->serializer = $serializer;
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$param = $this->getRequest()->getParam('marca_id');
		$this->cache->save(
            $this->serializer->serialize($param),
            self::TYPE_IDENTIFIER,
            [self::CACHE_TAG],
            86400
        );
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Distribuidora')));
        $resultPage->addBreadcrumb(__('moduleajax'), __('Lugares'));
        $resultPage->addBreadcrumb(__('moduleajax'), __('Distribuidora Lugares'));

		return $resultPage;
	}

	public function getCacheData($force= false){
		$cache = $this->cache->load(self::TYPE_IDENTIFIER);
        if($cache && !$force){
            return $this->serializer->unserialize($cache);
        }
		return "";
	}

}