<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-04
 * Time: 15:11
 */

namespace Vaimo\Mytest\Controller\Adminhtml\FunnyOrder;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Vaimo\Mytest\Api\FunnyOrderRepositoryInterface;
use Vaimo\Mytest\Model\FunnyOrderFactory;

/**
 * Class InlineEdit
 * @package Vaimo\Mytest\Controller\Adminhtml\FunnyOrder
 */
class InlineEdit extends AbstractFunnyOrder
{
    /**
     * @var JsonFactory
     */
    private $jsonFactory;
    /**
     * @var SearchCriteriaBuilderFactory
     */
    private $searchBuilderFactory;
    /**
     * @var FilterBuilder
     */
    private $filterBuilder;
    /**
     * @var FilterGroupBuilder
     */
    private $filterGroupBuilder;

    /**
     * InlineEdit constructor.
     *
     * @param FilterGroupBuilder $filterGroupBuilder
     * @param FilterBuilder $filterBuilder
     * @param SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
     * @param JsonFactory $jsonFactory
     * @param FunnyOrderFactory $fannyOrderFactory
     * @param PageFactory $pageFactory
     * @param FunnyOrderRepositoryInterface $orderRepository
     * @param Context $context
     */
    public function __construct(FilterGroupBuilder $filterGroupBuilder,
                                FilterBuilder $filterBuilder,
                                SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
                                JsonFactory $jsonFactory,
                                FunnyOrderFactory $fannyOrderFactory,
                                PageFactory $pageFactory,
                                FunnyOrderRepositoryInterface $orderRepository,
                                Context $context
    ) {
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->searchBuilderFactory = $searchCriteriaBuilderFactory;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($fannyOrderFactory, $pageFactory, $orderRepository, $context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $funnyOrderId) {
                    $order = $this->repository->getById($funnyOrderId);
                    try {
                        $order->setData(array_merge($order->getData(), $postItems[$funnyOrderId]));
                        $this->repository->save($order);
                    } catch (\Exception $e) {
                        $messages[] = __($e->getMessage());
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
