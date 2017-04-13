<?php
namespace Ecommistry\ProductList\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Resource setup
     *
     * @var ConfigInterface
     */
    private $_resource;

    /**
     * Get Scope Config Data
     *
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Get eavConfig Data
     *
     * @var Magento\Eav\Model\Config
     */
    private $eavConfig;

    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory,\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Framework\App\Config\ConfigResource\ConfigInterface $resource, \Magento\Eav\Model\Config $eavConfig)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->_resource = $resource;
        $this->eavConfig = $eavConfig;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $attribute = $this->getAttribute();

        /**
         * Add attributes to the eav/attribute
         */
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            $attribute,/* Custom Attribute Code */
            [
                'group' => 'Product Details',/* Group name in which you want to display your custom attribute */
                'type' => 'int',/* Data type in which formate your value save in database*/
                'backend' => '',
                'frontend' => '',
                'label' => 'Ecommistry Productlist Handle Display', /* lablel of your attribute*/
                'input' => 'select',
                'class' => '',
                'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                                    /*Scope of your attribute */
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => 1,
                'searchable' => false,
                'filterable' => true,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => false,
                'unique' => false
            ]
        );
    }

    public function getAttribute()
    {
        $possible_attributes = array('handle_display','productlist_handle_display','ecommistry_handle_display');
        $scopeConfig = $this->scopeConfig->getValue('ecommistry/productlist/attribute', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        
        foreach($possible_attributes as $possible_attribute)
        {
            $attr = $this->eavConfig->getAttribute(\Magento\Catalog\Model\Product::ENTITY, $possible_attribute);
            
            if(empty($attr->getId()) && !empty($scopeConfig)) {
                $attribute = $scopeConfig;
                break;
            }

            if(empty($attr->getId()) && empty($scopeConfig))
            {
                $attribute = $possible_attribute;
                $this->_resource->saveConfig('ecommistry/productlist/attribute', $attribute, 'default', 0);
                break;
            } 

            if(!empty($attr->getId()) && !empty($scopeConfig) && $possible_attribute == $scopeConfig) {
                $attribute = $possible_attribute;
                break;
            } 

        }

        return $attribute;
    }
}