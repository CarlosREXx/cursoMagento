<?php

namespace TorinoMotors\ModuleAjax\Ui\DataSource;

use Magento\Framework\App\Request\Http;

class NamesProvider extends \Magento\Ui\DataProvider\AbstractDataProvider{

    /**
     * @var \Magento\Ui\DataProvider\AddFieldToCollectionInterface[]
     */
    protected $addFieldStrategies;

    /**
     * @var \Magento\Ui\DataProvider\AddFilterToCollectionInterface[]
     */
    protected $addFilterStrategies;

    /** @var \Magento\Framework\App\Request\Http $request */
    protected $request;

    /** @var \TorinoMotors\ModuleAjax\Model\CustomCollection\CollectionNames $collectionNames */
    protected $collectionNames;

    protected $filter = [];

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Http $request,
        \TorinoMotors\ModuleAjax\Model\CustomCollection\CollectionNames $collectionNames,
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->request = $request;
        $this->collectionNames = $collectionNames;
    }

    public function getData(): array
    {
        $size = intval($this->request->getParam('paging')['pageSize']);
        $current = intval($this->request->getParam('paging')['current']);
        $data = $this->collectionNames->getCollection(['current' => $current, 'size' => $size]);
        if(!empty($this->filter)){
            $filter = $data->toArray();
            foreach($this->filter as $filtro){
                foreach($filter['items'] as $key => $item){
                    if(($item[$filtro['field']] == $filtro['value']) || strpos($item[$filtro['field']], $filtro['value'])){
                        continue;
                    }else{
                        $filter['totalRecords']--;
                        unset($filter['items'][$key]);
                    }
                }
            }
            //$filter = $data->getFirstItem()->toArray();
            $filter['items'] = array_values($filter['items']);
            return $filter;
        }
        return $data->toArray();  
    }

    public function setLimit($offset, $size)
    {
    }

    public function addOrder($field, $direction)
    {
    }

    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
       $this->filter[] = ['field' => $filter->getField(), 'value' => str_replace('%', '', $filter->getValue()), 'conditionType' => $filter->getConditionType()];
        return $this;
    }
}