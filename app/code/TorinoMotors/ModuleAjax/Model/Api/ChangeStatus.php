<?php
namespace TorinoMotors\ModuleAjax\Model\Api;
use TorinoMotors\ModuleAjax\Api\ChangeStatusInterface;
use TorinoMotors\ModuleAjax\Model\ResourceModel\Fiesta\CollectionFactory;
class ChangeStatus implements ChangeStatusInterface
{

    /** @var TorinoMotors\ModuleAjax\Model\ResourceModel\Fiesta\CollectionFactory $collectionFiesta */
    protected $collectionFiesta;

    public function __construct(
        CollectionFactory $collectionFiesta,
        \Psr\Log\LoggerInterface $logger
    ){
        $this->collectionFiesta = $collectionFiesta;
        $this->_logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function updateDataApi($id = "")
    {   
        if(!$id){
            throw new \Magento\Framework\Exception\NoSuchEntityException(__('You need send id')); 
        }
        $section = $this->collectionFiesta->create()
        ->addFieldToFilter('rh_id', ['eq' => $id])->getData();
        if(count($section) == 0){
            throw new \Magento\Framework\Exception\NoSuchEntityException(__('SubCategory id does not exist.'));
        }else{
            $section[0]['data_items'] ? $dataRow = json_decode($section[0]['data_items'], JSON_OBJECT_AS_ARRAY) : $dataRow = []; 
            (count($dataRow) > 0) ? $record_id = count($dataRow) : $record_id = 0;
            $arrayData = [
                            "date" => "", "link" => $link, "time_video" => "", 
                            "title" => $title, "sub_title" => $subtitle, "desc_title" => $descTitle,
                            "description" => $description, "enabled" => "1", "initialize" => true, "record_id" => $record_id
                         ];
            $dataRow[] = $arrayData;
            $dataRow = json_encode($dataRow, JSON_UNESCAPED_UNICODE);
        }
      
        return 'successfully update';
    }
}