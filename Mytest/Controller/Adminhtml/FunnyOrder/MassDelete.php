<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-05
 * Time: 12:33
 */

namespace Vaimo\Mytest\Controller\Adminhtml\FunnyOrder;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Vaimo\Mytest\Api\FunnyOrderRepositoryInterface;
use Vaimo\Mytest\Model\FunnyOrderFactory;
use Vaimo\Mytest\Model\FunnyOrderInterface;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;

/**
 * Class MassDelete
 * @package Vaimo\Mytest\Controller\Adminhtml\FunnyOrder
 */
class MassDelete extends AbstractFunnyOrder
{
    /**
     * @var SearchCriteriaBuilderFactory
     */
    private $searchCriteriaBuilderFactory;

    /**
     * MassDelete constructor.
     *
     * @param SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
     * @param FunnyOrderFactory $fannyOrderFactory
     * @param PageFactory $pageFactory
     * @param FunnyOrderRepositoryInterface $orderRepository
     * @param Context $context
     */
    public function __construct(SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
                                FunnyOrderFactory $fannyOrderFactory,
                                PageFactory $pageFactory,
                                FunnyOrderRepositoryInterface $orderRepository,
                                Context $context
    ) {
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        parent::__construct($fannyOrderFactory, $pageFactory, $orderRepository, $context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            throw new \Magento\Framework\Exception\NotFoundException(__('Elements not found.'));
        }
        $ids = $this->getRequest()->getParam('selected');
        $excluded = $this->getRequest()->getParam('excluded');
        if($ids) {
            try {
                foreach ($ids as $id) {
                    $this->repository->deleteById($id);
                }
                $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', count($ids)));
                return $this->redirectToGrid();
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go to grid
                return $this->redirectToGrid();
            }
        } elseif ($excluded) {
            $searchCriteriaBuilder = $this->searchCriteriaBuilderFactory->create();
            $searchCriteria = $searchCriteriaBuilder->addFilter(FunnyOrderInterface::FIELD_ID, $excluded, 'nin')->create();
            $listElevators = $this->repository->getList($searchCriteria)->getItems();

            foreach ($listElevators as $elevator) {
                $this->repository->delete($elevator);
            }
        }
        return $this->redirectToGrid();
    }
}
