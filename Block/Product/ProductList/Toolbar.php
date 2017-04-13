<?php
namespace Ecommistry\ProductList\Block\Product\ProductList;

use Magento\Catalog\Helper\Product\ProductList;
use Magento\Catalog\Model\Product\ProductList\Toolbar as ToolbarModel;

class Toolbar extends \Magento\Catalog\Block\Product\ProductList\Toolbar
{

	/**
     * scopeConfig settings
     *
     * @var \Magento\Framework\View\Element\Template\Context scopeConfig
     */
    protected $scopeConfig;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Catalog\Model\Session $catalogSession
     * @param \Magento\Catalog\Model\Config $catalogConfig
     * @param ToolbarModel $toolbarModel
     * @param \Magento\Framework\Url\EncoderInterface $urlEncoder
     * @param ProductList $productListHelper
     * @param \Magento\Framework\Data\Helper\PostHelper $postDataHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\Session $catalogSession,
        \Magento\Catalog\Model\Config $catalogConfig,
        ToolbarModel $toolbarModel,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        ProductList $productListHelper,
        \Magento\Framework\Data\Helper\PostHelper $postDataHelper,
        array $data = []
    ) {
    	$this->scopeConfig = $context->getScopeConfig();
        parent::__construct(
        					$context,
        					$catalogSession,
        					$catalogConfig,
        					$toolbarModel,
        					$urlEncoder,
        					$productListHelper,
        					$postDataHelper,
        					$data
        					);
    }


	/**
     * Set collection to pager
     *
     * @param \Magento\Framework\Data\Collection $collection
     * @return $this
     */
    public function setCollection($collection)
    {
        $this->_collection = $collection;

        // we need to set pagination only if passed value integer and more that 0
        $newLimit = $this->getNewLimit();
        if ($newLimit) {
            $this->_collection->setPageSize($newLimit);
            $this->_collection->setCurPage(1);
        } else {
        	$limit = (int)$this->getLimit();
        	if($limit)
        		$this->_collection->setPageSize($limit);

        	$this->_collection->setCurPage($this->getCurrentPage());
        }
        if ($this->getCurrentOrder()) {
            $this->_collection->setOrder($this->getCurrentOrder(), $this->getCurrentDirection());
        }
        return $this;
    }

    public function getNewLimit()
    {
    	return (int)$this->scopeConfig->getValue('productlist/general/product_limit', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
