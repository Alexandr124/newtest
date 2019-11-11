<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-05
 * Time: 09:30
 */

namespace Vaimo\Mytest\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\Session\SessionManagerInterface;
use Vaimo\Mytest\Model\ResourceModel\FunnyOrder\CollectionFactory;

/**
 * Class FunnyOrderDataProvider
 * @package Vaimo\Mytest\DataProvider
 */
class FunnyOrderDataProvider extends AbstractDataProvider
{
    /**
     * @var SessionManagerInterface
     */
    private $sessionManager;

    /**
     * FunnyOrderDataProvider constructor.
     *
     * @param SessionManagerInterface $sessionManager
     * @param CollectionFactory $collectionFactory
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(SessionManagerInterface $sessionManager,
                                CollectionFactory $collectionFactory,
                                $name,
                                $primaryFieldName,
                                $requestFieldName,
                                array $meta = [], array $data = []
    ) {
        $this->sessionManager = $sessionManager;
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        $model = $this->sessionManager->getCurrentFunnyOrderModel();
        $this->sessionManager->setCurrentFunnyOrderModel(null);
        if ($model != null) {
            return [$model->getId() => $model->getData()];
        } else {
            return [];
        }
    }
}
