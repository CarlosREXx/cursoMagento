<?php 

namespace TorinoMotors\ModuleWebApi\Model;

class Image extends \Magento\Framework\Model\AbstractModel implements \TorinoMotors\ModuleWebApi\Api\Data\ImageInterface
{
    /**
     * Initialize TorinoMotors Image Model
     * 
     * @return void
     */
    protected function _construct()
    {
        /**_init($resourceModel) */
        $this->_init("TorinoMotors\ModuleWebApi\Model\ResourceModel\Image");
    }

    /**
     * Get Image entity 'image_id' property value
     * 
     * @api
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::PROPERTY_ID);
    }

    /**
     * Set Image entity 'image_id' property value
     * 
     * @api
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->setData(self::PROPERTY_ID, $id);
        return $this;
    }

    /**
     * Get Image entity 'image_id' property value
     * 
     * @api
     * @return int|null
     */
    public function getImageId()
    {
        return $this->getData(self::PROPERTY_IMAGE_ID);
    }

    /**
     * Set Image entity 'image_id' property value
     * 
     * @api
     * @param int $imageId
     * @return $this
     */
    public function setImageId($imageId)
    {
        $this->setData(self::PROPERTY_SLIDE_ID, $imageId);
        return $this;
    }

    /**
     * Get Image entity 'slide_id' property value
     * 
     * @api
     * @return int|null
     */
    public function getSlideId()
    {
        return $this->getData(self::PROPERTY_SLIDE_ID);
    }

    /**
     * Set Image entity 'slide_id' property value
     * 
     * @api
     * @param int $slideId
     * @return $this
     */
    public function setSlideId($slideId)
    {
        $this->setData(self::PROPERTY_SLIDE_ID, $slideId);
        return $this;
    }

    /**
     * Get Image entity 'path' property value
     * 
     * @api
     * @return string|null
     */
    public function getPath()
    {
        return $this->getData(self::PROPERTY_PATH);
    }

    /**
     * Set Image entity 'path' property value
     * 
     * @api
     * @param int $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->setData(self::PROPERTY_PATH, $path);
        return $this;
    }
}