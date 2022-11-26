<?php

namespace TorinoMotors\ModuleAjax\Api;

/**
 * @api 
 */

 interface ChangeStatusInterface
 {
    /**
     * Update Status by id
     * @param string $id
     * @throws \Magento\Framework\Exception\NoSuchEntityException If sub_category with specified ID doesn't exist
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return string
     */
    public function updateDataApi($id = "");
 }