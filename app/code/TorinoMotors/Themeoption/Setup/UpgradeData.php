<?php

namespace TorinoMotors\Themeoption\Setup;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Entity\Attribute\Set as AttributeSet;
use Magento\Catalog\Model\ResourceModel\Product as ResourceProduct;

use Magento\Catalog\Api\Data\CategoryInterfaceFactory;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class UpgradeData implements UpgradeDataInterface
{   

    /** @param \Magento\Framework\ObjectManagerInterface $objectManager */
    protected $objectManager;

    /** @var \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory */
    private $eavSetupFactory;
    private $attributeSetFactory;
    private $attributeSet;
    private $categorySetupFactory;

    protected $_attributeSet;
    protected $_resourceProduct;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        AttributeSet $attributeSet,
        ResourceProduct $resourceProduct,
        EavSetupFactory $eavSetupFactory,
        CategoryRepositoryInterface $categoryRepository,
        CategoryInterfaceFactory $categoryInterfaceFactory,
        AttributeSetFactory $attributeSetFactory,
        CategorySetupFactory $categorySetupFactory
    ){
        $this->objectManager = $objectManager;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->_attributeSet  = $attributeSet;
        $this->_resourceProduct = $resourceProduct;
        $this->categoryRepositoryInterface = $categoryRepository;
        $this->categoryInterfaceFactory = $categoryInterfaceFactory;
        $this->attributeSetFactory = $attributeSetFactory; 
        $this->categorySetupFactory = $categorySetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if(version_compare($context->getVersion(), "1.0.1") < 0){
            $categories = ['Motocicletas', 'Accesorios', 'Ropa'];
            foreach ($categories as $category) {
                $dataCatego = $this->prepareData($category, 2, strtolower($category));
                $this->createCategory($dataCatego);
            }
        }

        if(version_compare($context->getVersion(), "1.0.2") < 0){
            $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
            $attributeSet = $this->attributeSetFactory->create();
            $entityTypeId = $categorySetup->getEntityTypeId(\Magento\Catalog\Model\Product::ENTITY);
            $attributeSetId = $categorySetup->getDefaultAttributeSetId($entityTypeId);
                    
            $data = [
                'attribute_set_name' => 'Motocicletas',
                'entity_type_id' => $entityTypeId,
                'sort_order' => 0
            ];
            try {
                $attributeSet->setData($data);
                $attributeSet->validate();
                $attributeSet->save();
                $attributeSet->initFromSkeleton($attributeSetId);
                $attributeSet->save();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'ficha_tecnica',
                [
                    'type' => 'text',
                    'label' => 'Ficha Técnica',
                    'input' => 'file',
                    'backend' => 'TorinoMotors\Themeoption\Model\Product\Attribute\Backend\File',
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => true,
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                    'visible_on_front' => true,
                    'attribute_set_id' => 'Motocicletas',
                    'apply_to' => 'simple,configurable', // applicable for simple and configurable product 
                    'used_in_product_listing' => false
                ]
            );
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'type_moto',
                [
                    'type' => 'int',
                    'label' => 'Tipo',
                    'input' => 'select',
                    'source' => 'TorinoMotors\Themeoption\Model\Config\Source\Type',
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'configurable' => true,
                    'visible' => true,
                    'visible_in_advanced_serach' => true,
                    'required' => false,
                    'user_defined' => true,
                    'searchable' => true,
                    'filterable' => true,
                    'comparable' => true,
                    'visible_on_front' => true,
                    'attribute_set_id' => 'Motocicletas',
                    'apply_to' => 'simple,virtual,configurable', // applicable for simple and configurable product 
                    'used_in_product_listing' => false
                ]
            );
            $groupName = 'Product Details';
            $customAttributeSetId = $categorySetup->getAttributeSetId($entityTypeId , 'Motocicletas');
            $categorySetup->addAttributeGroup($entityTypeId, $customAttributeSetId, $groupName, 0);
            $attributeGroupId = $categorySetup->getAttributeGroupId($entityTypeId, $customAttributeSetId, $groupName);
            $id = $categorySetup->getAttributeId($entityTypeId, 'ficha_tecnica');
            $categorySetup->addAttributeToGroup($entityTypeId, $customAttributeSetId, $attributeGroupId, $id, null);
            $id = $categorySetup->getAttributeId($entityTypeId, 'type_moto');
            $categorySetup->addAttributeToGroup($entityTypeId, $customAttributeSetId, $attributeGroupId, $id, null);
            // $eavSetup->removeAttribute(
            //     \Magento\Catalog\Model\Product::ENTITY,
            //      'ficha_tecnica');
        }
        $setup->endSetup();
    }

    protected function prepareData(string $category, $parent_id = 2, $url = ""){
        $dataCatego = [
            'data' => [
                'name' => $category,
                'parent_id' => $parent_id,
                'is_active' => true,
                'include_in_menu' => false
            ],
            'custom_attributes' => [
                'meta_title' => $url
            ]
        ];

        return $dataCatego;
    }

    protected function createCategory(array $data){
        $logger = $this->objectManager->create('\Psr\Log\LoggerInterface');
        try{
            $setCategory = $this->objectManager->create('\Magento\Catalog\Model\Category', $data)
                            ->setCustomAttributes($data['custom_attributes']);
            $setRepository = $this->objectManager->get(CategoryRepositoryInterface::class);
            $result = $setRepository->save($setCategory);
            $logger->info(__('Se creo exitosamente la Categoria '.$data['data']['name']));
            return true;
        }catch(\Exception $e){
            $logger->error(__('Fallo al intentar crear la Categoria [ERROR]: '. $e->getMessage()));
        }
    }
}