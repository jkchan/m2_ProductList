<?php
namespace Ecommistry\ProductList\Block\Customer;

class ListProduct extends \Magento\Catalog\Block\Product\ListProduct
{
	/**
     * Get Scope Config Data
     *
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Get Product Collection
     *
     * @var ProductCollection Factory
     */
    private $_productCollectionFactory;

    /**
     * @param Context $context
     * @param \Magento\Framework\Data\Helper\PostHelper $postDataHelper
     * @param \Magento\Catalog\Model\Layer\Resolver $layerResolver
     * @param CategoryRepositoryInterface $categoryRepository
     * @param \Magento\Framework\Url\Helper\Data $urlHelper
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Data\Helper\PostHelper $postDataHelper,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        array $data = []
    ) {
        $this->scopeConfig = $context->getScopeConfig();
        $this->_productCollectionFactory = $productCollectionFactory; 
        parent::__construct(
            $context,
            $postDataHelper,
            $layerResolver,
            $categoryRepository,
            $urlHelper,
            $data
        );
    }

	/**
     * Retrieve loaded category collection
     *
     * @return AbstractCollection
     */
    protected function _getProductCollection()
    {
        if ($this->_productCollection === null) {
            
            $collection = $this->_productCollectionFactory->create();
        	$collection->addAttributeToSelect('*');

        	$attributeUsed = $this->scopeConfig->getValue('ecommistry/productlist/attribute', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        	$collection->addAttributeToFilter($attributeUsed,['eq'=>1]);

        	$this->_productCollection = $collection;   
        }

        return $this->_productCollection;
    }

    public function getLimit()
    {
    	return (int)$this->scopeConfig->getValue('productlist/general/product_limit', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
