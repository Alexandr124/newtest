<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-04
 * Time: 13:51
 */

namespace Vaimo\Mytest\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Vaimo\Mytest\Model\FunnyOrderFactory;
use Vaimo\Mytest\Api\FunnyOrderRepositoryInterface;

/**
 * Class UpgradeData
 * @package Vaimo\Mytest\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    private $modelFactory;
    private $repository;
    public function __construct(FunnyOrderFactory $orderFactory, FunnyOrderRepositoryInterface $repository)
    {
        $this->modelFactory = $orderFactory;
        $this->repository   = $repository;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @throws \Exception
     *
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.2.6','<')) {
            $dataStart = new \DateTime();
            for ($i = 1; $i<6; $i++) {
                $dataStart = $dataStart->add(new \DateInterval('PT4H'));
                $dataEnd   = $dataStart->add(new \DateInterval('PT3H'));
                $model = $this->modelFactory->create();
                $model->setFunStart($dataStart);
                $model->setFunEnd($dataEnd);
                $model->setPhone($i.$i.$i.$i.$i.$i.$i);
                $model->setWish('My wish is >>>>');
                $model->setStatus($i%2);
                $this->repository->save($model);
            }
        }
    }
}
