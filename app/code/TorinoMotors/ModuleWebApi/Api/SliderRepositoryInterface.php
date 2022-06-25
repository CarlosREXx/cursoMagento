<?php

namespace TorinoMotors\ModuleWebApi\Api;

/**
 * @api
 */
interface SliderRepositoryInterface
{
    /**
     * Retrive slide entity
     * @param int $slideId
     * @return \TorinoMotors\ModuleWebApi\Api\Data\SlideInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If slide with specified ID doesn't exist
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($slideId);

    /**
     * Save slide
     * @param \TorinoMotors\ModuleWebApi\Api\Data\SlideInterface $slide
     * @return \TorinoMotors\ModuleWebApi\Api\Data\SlideInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\TorinoMotors\ModuleWebApi\Api\Data\SlideInterface $slide);

    /**
     * Retrieve slides matching the specified criteria
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchCriteriaInterface 
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete slide by ID
     * @param int $slideId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($slideId);
}