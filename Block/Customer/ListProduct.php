<?php
namespace Ecommistry\ProductList\Block\Customer;

class ListProduct extends \Magento\Catalog\Block\Product\ListProduct
{
	/**
     * Retrieve loaded category collection
     *
     * @return AbstractCollection
     */
    public function getLoadedProductCollection()
    {
    	$this->_getProductCollection()->addAttributeToSelect('handle_display')->addAttributeToFilter('handle_display',['eq'=>0]);

        return $this->_getProductCollection();
    }
}
