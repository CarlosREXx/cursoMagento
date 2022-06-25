<?php 

namespace TorinoMotors\ModuleWebApi\Api;

/**
 * @api
 */
interface ImageRepositoryInterface
{
    /**
     * Retrive image entity
     * @param int $imageId
     * @return \TorinoMotors\ModuleWebApi\Api\Data\ImageInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If image with specified ID doesn't exist
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($imageId);

    /**
     * Save image
     * @param \TorinoMotors\ModuleWebApi\Api\Data\ImageInterface $image
     * @return \TorinoMotors\ModuleWebApi\Api\Data\ImageInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\TorinoMotors\ModuleWebApi\Api\Data\ImageInterface $image);

    /**
     * Retrieve images matching the specified criteria
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchCriteriaInterface 
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete image by ID
     * @param int $imageId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($imageId);
}