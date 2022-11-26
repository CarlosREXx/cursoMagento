<?php

namespace TorinoMotors\ModuleAjax\Model;

use TorinoMotors\ModuleAjax\Model\ResourceModel\Marcas\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        CollectionFactory $suscriptionCollectionFactory,
        array $meta = [],
        array $data = []
    ){
        $this->storeManager = $storeManager;
        $this->collection = $suscriptionCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if(isset($this->loadedData)){
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $this->loadedData[$model->getMarcaId()] = $model->getData();
            if ($model->getImagen()) {
                $m['imagen'][0]['name'] = $model->getImagen();
                $m['imagen'][0]['url'] = $this->getMediaUrl().$model->getImagen();
                $m['imagen'][0]['previewType'] = 'image';
                $m['imagen'][0]['file'] = $model->getImagen();
                //$m['imagen'][0]['type'] = 'image/png';
                $fullData = $this->loadedData;
                $this->loadedData[$model->getMarcaId()] = array_merge($fullData[$model->getMarcaId()], $m);
            }
        }
        return $this->loadedData;
    }

    public function getMediaUrl()
    {
        $mediaUrl = $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'image/marcas/';
        return $mediaUrl;
    }
}
