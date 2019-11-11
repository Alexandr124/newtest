<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-10-15
 * Time: 18:02
 */

namespace Vaimo\Mytest\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Model\StoreFactory;
use Magento\Store\Model\WebsiteFactory;
use Magento\Store\Model\StoreRepository;

/**
 * Class InstallData
 * @package Vaimo\Mytest\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var StoreFactory
     */
    private $storeFactory;
    /**
     * @var WebsiteFactory
     */
    private $websiteFactory;
    /**
     * @var StoreRepository
     */
    private $storeRepository;

    /**
     * InstallData constructor.
     *
     * @param StoreManagerInterface $storeManager
     * @param StoreFactory $storeFactory
     * @param WebsiteFactory $websiteFactory
     * @param StoreRepository $storeRepository
     */
    public function __construct(StoreManagerInterface $storeManager,
                                StoreFactory $storeFactory,
                                WebsiteFactory $websiteFactory,
                                StoreRepository $storeRepository
    ) {
        $this->storeFactory = $storeFactory;
        $this->storeManager = $storeManager;
        $this->websiteFactory = $websiteFactory;
        $this->storeRepository = $storeRepository;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->create_start_store();
    }

    /**
     *
     */
    private function create_start_store()
    {
        $store = $this->storeFactory->create();
        $store->load('my_TWO_store_code');
        if (!$store->getId()) {
            $website = $this->websiteFactory->create();
            $website->load($this->storeManager->getDefaultStoreView()->getWebsiteId());
            $store->setCode('my_TWO_store_code');
            $store->setName('My TWO store');
            $store->setWebsite($website);
            $store->setData('is_active', '1');
            $store->setGroupId(1);
            $store->save();
        }
    }
}
