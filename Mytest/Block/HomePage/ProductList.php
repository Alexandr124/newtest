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

/**
 * Class ProductList
 * @package Vaimo\Mytest\Block\HomePage
 */
class ProductList extends Template
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var SearchCriteriaInterface
     */
    private $searchCriteria;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;
    /**
     * @var Image
     */
    private $imageHelper;

    /**
     * ProductList constructor.
     *
     * @param Image $imageHelper
     * @param CategoryRepositoryInterface $categoryInterface
     * @param CollectionFactory $collectionFactory
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaInterface $criteria
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(Image $imageHelper,
                                CategoryRepositoryInterface $categoryInterface,
                                CollectionFactory $collectionFactory,
                                ProductRepositoryInterface $productRepository,
                                SearchCriteriaInterface $criteria,
                                Template\Context $context, array $data = []
    ) {
        $this->imageHelper = $imageHelper;
        $this->categoryRepository = $categoryInterface;
        $this->collectionFactory = $collectionFactory;
        $this->productRepository = $productRepository;
        $this->searchCriteria = $criteria;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getProductData()
    {
        $collection = $this->collectionFactory->create();
        $collection->joinField(
            'qty', 'cataloginventory_stock_item', 'qty', 'product_id=entity_id', '{{table}}.stock_id=1', 'left'
        );
        $collection->addAttributeToFilter('qty', ['eq' => 0]);
        $collection->load();
        $products = array();
        foreach ($collection as $item) {
            $product = $this->productRepository->getById($item->getId());
            $image_url = $this->imageHelper->init($product, 'product_thumbnail_image')
                ->setImageFile($product->getFile())
                ->resize(200, 300)
                ->getUrl();
            $product->setMyImageUrl($image_url);
            $products[] = $product;
        }

        return $products;
    }
}
