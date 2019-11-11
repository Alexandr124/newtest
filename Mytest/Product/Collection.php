<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-10-31
 * Time: 08:29
 */

namespace Vaimo\Mytest\Product;

/**
 * Class Collection
 * @package Vaimo\Mytest\Product
 */
class Collection extends \Magento\Catalog\Model\ResourceModel\Collection\AbstractCollection
{
    /**
     *
     */
    protected function _construct()
    {

        $this->_init(\Magento\Catalog\Model\Product::class, \Magento\Catalog\Model\ResourceModel\Product::class);
        $this->_initTables();
    }

    /**
     *
     */
    protected function _initTables()
    {
        $this->_productWebsiteTable = $this->getResource()->getTable('catalog_product_website');
        $this->_productCategoryTable = $this->getResource()->getTable('catalog_category_product');
    }
}