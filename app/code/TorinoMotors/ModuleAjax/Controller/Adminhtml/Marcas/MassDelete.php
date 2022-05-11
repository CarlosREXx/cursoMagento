<?php

namespace TorinoMotors\ModuleAjax\Controller\Adminhtml\Marcas;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use TorinoMotors\ModuleAjax\Model\ResourceModel\Marcas\CollectionFactory;
use TorinoMotors\ModuleAjax\Model\ImageUploader;

class MassDelete extends Action
{
    protected $collectionFactory;
    protected $filter;
    protected $deleteImage;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory, 
        ImageUploader $deleteImage
    ){
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;
        $this->deleteImage = $deleteImage;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();
            foreach($collection as $model){
                //$deleteItem = $this->_ObjectManager->get("TorinoMotors\Refacciones\Model\Suscription")->load($model->getId());
                if($model->getImagen()){
                    $deleteImgMessage = $this->deleteImage->removeFile("image/marcas/" . $model->getImagen());
                    $this->messageManager->addSuccessMessage(__($deleteImgMessage));
                }
                $model->delete();
            }
            $this->messageManager->addSuccessMessage(__("Un total de $collectionSize Marca(s) se han eliminado"));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath("*/*/");
    }
}