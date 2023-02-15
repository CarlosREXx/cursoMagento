<?php

namespace TorinoMotors\ModuleAjax\Model\CustomCollection;

class CollectionNames{

    /** @var \Magento\Framework\Data\CollectionFactory $collectionFactory */
    protected $collectionFactory;

    /** @var \Magento\Framework\Data\Collection $collection */
    protected $collection;

    /** @var int */
    protected $pageSize;

    /** @var int */
    protected $pageCurrent;

    private $data = [
        ['id' => 1, 'name' => 'Carlos Rocha', 'genero' => 'Masculino'],
        ['id' => 2, 'name' => 'Mariana Ocampo', 'genero' => 'Femenino'],
        ['id' => 3, 'name' => 'Fernanda Ruiz', 'genero' => 'Femenino'],
        ['id' => 4, 'name' => 'Cesar Torres', 'genero' => 'Masculino'],
        ['id' => 5, 'name' => 'Jana Lopez', 'genero' => 'Femenino'],
        ['id' => 6, 'name' => 'Gerardo Beltran', 'genero' => 'Masculino'],
        ['id' => 7, 'name' => 'Gerardo Beltran', 'genero' => 'Masculino'],
        ['id' => 8, 'name' => 'Margarita Beltran', 'genero' => 'Femenino']
    ];
    public function __construct(
        \Magento\Framework\Data\CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
    }

    final protected function setCollection(): void{
        $collection = $this->collectionFactory->create();
        $pageOffset = ($this->pageCurrent - 1) * $this->pageSize;
        $data = array_slice($this->data, $pageOffset, $pageOffset+$this->pageSize);
        foreach($data as $item){
            $dataObject = new \Magento\Framework\DataObject();
            $dataObject->setData($item);
            $collection->addItem($dataObject);
        }
        $this->collection = $collection;
    }

    public function getCollection(array $paging): \Magento\Framework\Data\Collection{
        $this->pageCurrent = isset($paging['current']) ? $paging['current'] : null;
        $this->pageSize = isset($paging['size']) ? $paging['size'] : null;
        //$this->pageOffset = isset($paging['offset']) ? $paging['offset'] : null;
        if($this->pageCurrent === null || $this->pageSize === null){
            throw new \Exception(__('Some of these elements are missing: current, size'));
        }
        if(!is_int($this->pageCurrent) || !is_int($this->pageSize)){
            throw new \Exception(__("Some of these elements aren't integer: current, size"));
        }
        $this->setCollection();
        return $this->collection;
    }
}