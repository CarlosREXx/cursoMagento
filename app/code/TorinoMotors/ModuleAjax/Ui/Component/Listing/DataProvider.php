<?php

namespace TorinoMotors\ModuleAjax\Ui\Component\Listing;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\Request\Http;

/**
 * Class ProductDataProvider
 */
class DataProvider extends AbstractDataProvider
{

    /**
     * @var \Magento\Ui\DataProvider\AddFieldToCollectionInterface[]
     */
    protected $addFieldStrategies;

    /**
     * @var \Magento\Ui\DataProvider\AddFilterToCollectionInterface[]
     */
    protected $addFilterStrategies;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;

    /**
     * Construct
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Http $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->request = $request;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        $items = [
            ['dealer_place_id' => "1", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "2", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "3", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "4", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "5", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "6", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "7", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "8", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "9", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "10", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "11", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "12", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "13", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "14", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "15", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "16", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "17", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "18", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "19", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "20", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "21", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "22", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "23", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "24", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "25", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "26", 'dealer_place' => 'dddd'],
            ['dealer_place_id' => "27", 'dealer_place' => 'dddd'],
        ];

        $pagesize = intval($this->request->getParam('paging')['pageSize']);
        $pageCurrent = intval($this->request->getParam('paging')['current']);
        $pageoffset = ($pageCurrent - 1)*$pagesize;

        return [
            'totalRecords' => count($items),
            'items' => array_slice($items,$pageoffset , $pageoffset+$pagesize),
        ];
    }

    // ###########################################

    public function setLimit($offset, $size)
    {
    }

    public function addOrder($field, $direction)
    {
    }

    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
    }
}