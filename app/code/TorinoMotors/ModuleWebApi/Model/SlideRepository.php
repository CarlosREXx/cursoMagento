<?php

namespace TorinoMotors\ModuleWebApi\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\TemporaryState\CouldNotSaveException;
use Magento\Framework\Exception\Test\Unit\NoSuchEntityExceptionTest;

class SlideRepository implements \TorinoMotors\ModuleWebApi\Api\SliderRepositoryInterface
{
    /**
     * @var \TorinoMotors\ModuleWebApi\Model\ResourceModel\Slide $resource
     */
    protected $resource;

    /**
     * @var \TorinoMotors\ModuleWebApi\Model\SlideFactory $slideFactory
     */
    protected $slideFactory;

    /**
     * @var \TorinoMotors\ModuleWebApi\Model\ResourceModel\Slide\CollectionFactory $slideCollectionFactory
     */
    protected $slideCollectionFactory;

    /**
     * @var \Magento\Framework\Api\SearchResultsInterface $searchResultsFactory
     */
    protected $searchResultsFactory;

    /**
     * @var \Magento\Framework\Api\DataObjectHelper $dataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var \Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var \TorinoMotors\ModuleWebApi\Api\Data\SlideInterfaceFactory $dataSlideFactory
     */
    protected $dataSlideFactory;

    /**
     * @param ResourceModel\Slide $resource
     * @param SlideFactory $slideFactory
     * @param ResourceModel\Slide\CollectionFactory $slideCollectionFactory
     * @param \Magento\Framework\Api\SearchResultsInterface $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param \TorinoMotors\ModuleWebApi\Api\Data\SlideInterfaceFactory $dataSlideFactory
     */
    public function __construct(
        \TorinoMotors\ModuleWebApi\Model\ResourceModel\Slide $resource,
        \TorinoMotors\ModuleWebApi\Model\SlideFactory $slideFactory,
        \TorinoMotors\ModuleWebApi\Model\ResourceModel\Slide\CollectionFactory $slideCollectionFactory,
        \Magento\Framework\Api\SearchResultsInterface $searchResultsFactory,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper,
        \Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor,
        \TorinoMotors\ModuleWebApi\Api\Data\SlideInterfaceFactory $dataSlideFactory
    ){
        $this->resource = $resource;
        $this->slideFactory = $slideFactory;
        $this->slideCollectionFactory = $slideCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->dataSlideFactory = $dataSlideFactory;
    }

    /**
     * Retrieve slide entity
     * 
     * @api
     * @param int $slideId
     * @return \TorinoMotors\ModuleWebApi\Api\Data\SlideInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If slide with the specifies ID doesn't exist
     * @throws \Magneto\Framework\Exception\LocalizedException
     */
    public function getById($slideId)
    {
        $slide = $this->slideFactory->create();
        $this->resource->load($slide, $slideId);
        if(!$slide->getId()){
            throw new \Magento\Framework\Exception\NoSuchEntityException(__('Slide with id %1 does not exist.', $slideId));
        }
        return $slide;
    }

    /**
     * Save Slide
     * 
     * @param \TorinoMotors\ModuleWebApi\Api\Data\SlideInterface $slide
     * @return \TorinoMotors\ModuleWebApi\Api\Data\SlideInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\TorinoMotors\ModuleWebApi\Api\Data\SlideInterface $slide)
    {
        try{
            $this->resource->save($slide);
        }catch(\Exception $exception){
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $slide;
    }

    /**
     * Retrieve slides matching the specified criteria
     * 
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchCriteriaInterface 
     * @throws \Magento\Framework\Exception\LocalizedException
     */

     public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
     {
        $this->searchResultsFactory->setSearchCriteria($searchCriteria);

        $collection = $this->slideCollectionFactory->create();

        foreach($searchCriteria->getFilterGroups() as $filterGroup){
            foreach($filterGroup->getFilters() as $filter){
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $this->searchResultsFactory->setTotalCount($collection->getSize());
        $sortOrders = $searchCriteria->getSortOrders();
        if($sortOrders){
            foreach($sortOrders as $sortOrder){
                $collection->addOrder(
                    $sortOrder->getField(),
                    (strtoupper($sortOrder->getDirection() === 'ASC')) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());
        $slide = [];
        /** @var \TorinoMotors\ModuleWebApi\Model\Slide $slideModel */
        foreach($collection as $slideModel){
            $slideData = $this->dataSlideFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $slideData,
                $slideModel->getData(),
                '\TorinoMotors\MaoduleWebApi\Api\Data\SlideInterface'
            );
            $slides[] = $this->dataObjectProcessor->buildOutputDataArray(
                $slideData,
                '\TorinoMotors\MaoduleWebApi\Api\Data\SlideInterface'
            );
        }
        $this->searchResultsFactory->setItems($slides);
        return $this->searchResultsFactory;
     }

     /**
      * Delete Slide
      * 
      * @param \TorinoMotors\ModuleWebApi\Api\Data\SlideInterface $slide
      * @return bool
      * @throws CouldNotDeleteException
      */
      public function delete(\TorinoMotors\ModuleWebApi\Api\Data\SlideInterface $slide)
      {
        try{

        }catch(\Exception $exception){
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
      }

      /**
       * Delete slide by ID
       * 
       * @param int $slideId
       * @return bool true on success
       * @throws \Magento\Framework\Exception\NoSuchEntityException
       * @throws \Magento\Framework\Exception\LocalizedException
       */
      public function deleteById($slideId)
      {
        return $this->delete($this->getById($slideId));
      }
}