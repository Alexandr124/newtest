<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-04
 * Time: 09:04
 */

namespace Vaimo\Mytest\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Vaimo\Mytest\Api\FunnyOrderRepositoryInterface;
use Vaimo\Mytest\Model\FunnyOrderFactory;
use Vaimo\Mytest\Model\ResourceModel\FunnyOrder\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\Search\SearchResultInterfaceFactory;
use Vaimo\Mytest\Model\ResourceModel\FunnyOrder as ResourceModel;

class FunnyOrderRepository implements FunnyOrderRepositoryInterface
{
    private $searchResultFactory;
    private $funnyOrderFactory;
    private $resourceModel;
    private $collectionFactroy;
    private $collectionProcessor;
    public function __construct(SearchResultInterfaceFactory $searchResultInterfaceFactory,
                                CollectionProcessorInterface $collectionProcessor,
                                CollectionFactory $collectionFactory,
                                ResourceModel $resourceModel,
                                FunnyOrderFactory $funnyOrderFactory)
    {
        $this->searchResultFactory = $searchResultInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactroy   = $collectionFactory;
        $this->resourceModel       = $resourceModel;
        $this->funnyOrderFactory   = $funnyOrderFactory;
    }

    /**
     * @param $id
     *
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $funnyOrder = $this->funnyOrderFactory->create();
        $this->resourceModel->load($funnyOrder,$id);
        if(!$funnyOrder->getId()) {
            throw new NoSuchEntityException(__('Order with id "%1" does not exist.', $id));
        } else return $funnyOrder;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return mixed
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactroy->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        return $searchResult;

    }
    public function deleteById($id)
    {
        try {
            $this->delete($this->getById($id));
        } catch (NoSuchEntityException $e) {
        }
    }

    /**
     * @param FunnyOrderInterface $model
     *
     * @return $this
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(FunnyOrderInterface $model)
    {
        try {
            $this->resourceModel->delete($model);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(__($exception->getMessage()));
        }
        return $this;
    }

    /**
     * @param FunnyOrderInterface $model
     *
     * @return FunnyOrderInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(FunnyOrderInterface $model)
    {
        try {
            $this->resourceModel->save($model);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__($exception->getMessage()));
        }
        return $model;
    }
}
