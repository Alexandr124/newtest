<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-10-30
 * Time: 10:58
 */

namespace Vaimo\Mytest\Block\HomePage;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Catalog\Helper\Image;
use Vaimo\Mytest\Product\CollectionFactory;
use Magento\Catalog\Api\CategoryRepositoryInterface;

class ProductList extends Template
{
    private $productRepository;
    private $searchCriteria;
    private $collectionFactory;
    private $categoryRepository;
    private $imageHelper;


    public function __construct(Image $imageHelper,
                                CategoryRepositoryInterface $categoryInterface,
                                CollectionFactory $collectionFactory,
                                ProductRepositoryInterface $productRepository,
                                SearchCriteriaInterface $criteria,
                                Template\Context $context, array $data = []
    ) {
        $this->imageHelper         = $imageHelper;
        $this->categoryRepository  = $categoryInterface;
        $this->collectionFactory   = $collectionFactory;
        $this->productRepository   = $productRepository;
        $this->searchCriteria      = $criteria;

        parent::__construct($context, $data);
    }

    public function getProductData()
    {
        $collection = $this->collectionFactory->create();
        $collection->joinField(
            'qty', 'cataloginventory_stock_item', 'qty', 'product_id=entity_id', '{{table}}.stock_id=1', 'left'
        );
        $collection->addAttributeToFilter('qty',['eq'=>0]);
        $collection->load();
        $products = array();
        foreach ($collection as $item) {
            $product = $this->productRepository->getById($item->getId());
            $image_url = $this->imageHelper->init($product, 'product_thumbnail_image')->setImageFile($product->getFile())->resize(200, 300)->getUrl();
            $product->setMyImageUrl($image_url);
            $products[] = $product;
        }
        return $products;
    }
}