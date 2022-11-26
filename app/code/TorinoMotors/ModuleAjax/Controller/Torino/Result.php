<?php 

namespace TorinoMotors\ModuleAjax\Controller\Torino;

use Magento\Framework\App\Action\Context;


class Result extends \Magento\Framework\App\Action\Action
{
    const TYPE_IDENTIFIER = 'torinomotors_torino_type_id';
    const CACHE_TAG = 'TORINOMOTORS_TORINO_TYPE_TAG';

    protected $cache;
    
    protected $serializer;

    protected $torino;

    protected $resultJsonFactory;

    public function __construct(
        Context $context,
        \TorinoMotors\ModuleAjax\Service\torinoServiceAPI $torinoServiceAPI,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\App\CacheInterface $cache,
        \Magento\Framework\Serialize\SerializerInterface $serializer
    )
    {
        $this->serializer = $serializer;
        $this->cache = $cache;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->torino = $torinoServiceAPI;
        parent::__construct($context);
    }

    public function execute()
    {
        $param = $this->getRequest()->getParam('category');
        $resultJson = $this->resultJsonFactory->create();
        $cache = $this->loadCache();
        if($param){
            if(!$cache){
                $torinoData = $this->torino->getDataMotos($param);
                $this->cache->save(
                    $this->serializer->serialize($torinoData),
                    self::TYPE_IDENTIFIER,
                    [self::CACHE_TAG],
                    86400
                );
                $resultJson->setData(['data' => $torinoData]);
                return $resultJson;
            }
            $resultJson->setData(['data' => $cache]);
            return $resultJson;
        }
        $this->messageManager->addError('No existe el id indicado');
        return $this->resultRedirectFactory->create()->setPath('ajaxrequest/index');
    }

    protected function loadCache($force = false){
        $cache = $this->cache->load(self::TYPE_IDENTIFIER);
        if($cache && !$force){
            return $this->serializer->unserialize($cache);
        }
        return false;
    }
}