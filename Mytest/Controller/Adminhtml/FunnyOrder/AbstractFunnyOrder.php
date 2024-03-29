<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-04
 * Time: 13:37
 */

namespace Vaimo\Mytest\Controller\Adminhtml\FunnyOrder;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Vaimo\Mytest\Model\FunnyOrderFactory;
use Vaimo\Mytest\Api\FunnyOrderRepositoryInterface;

/**
 * Class AbstractOrder
 * @package Vaimo\Mytest\Controller\Adminhtml\FunnyOrder
 */
abstract class AbstractFunnyOrder extends Action
{
    /**
     *
     */
    const ACL_RESOURCE = "Mytest_Elevator::funnyOrder";
    /**
     *
     */
    const QUERY_PARAM_ID = 'id';
    /**
     *
     */
    const TITLE = 'Funny Order';
    /**
     *
     */
    const BREADCRUMB_TITLE = 'Funny Order';
    /**
     * @var
     */
    protected $orderModel;
    /**
     * @var FunnyOrderRepositoryInterface
     */
    protected $repository;
    /**
     * @var PageFactory
     */
    protected $pageFactory;
    /**
     * @var
     */
    protected $collectionFactory;
    /**
     * @var FunnyOrderFactory
     */
    protected $orderFactory;
    /**
     * @var
     */
    private $resultPage;

    /**
     * AbstractFunnyOrder constructor.
     *
     * @param FunnyOrderFactory $fannyOrderFactory
     * @param PageFactory $pageFactory
     * @param FunnyOrderRepositoryInterface $orderRepository
     * @param Context $context
     */
    public function __construct(
        FunnyOrderFactory $fannyOrderFactory,
        PageFactory $pageFactory,
        FunnyOrderRepositoryInterface $orderRepository,
        Context $context
    ) {
        $this->pageFactory = $pageFactory;
        $this->repository = $orderRepository;
        $this->orderFactory = $fannyOrderFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    protected function _getResultPage()
    {
        if (null === $this->resultPage) {
            $this->resultPage = $this->pageFactory->create();
        }

        return $this->resultPage;
    }

    /**
     * @return $this
     */
    protected function _setPageData()
    {
        $resultPage = $this->_getResultPage();
        $resultPage->getConfig()->getTitle()->prepend((__(static::TITLE)));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));

        return $this;
    }

    /**
     * @return bool
     */
    public function _isAllowed()
    {
        $result = parent::_isAllowed(); // TODO: Change the autogenerated stub
        $result = $result && $this->_authorization->isAllowed($this::ACL_RESOURCE);

        return $result;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface
     */
    protected function redirectToGrid()
    {
        return $this->_redirect('*/*/listing');
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    protected function doRefererRedirect()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($this->_redirect->getRefererUrl());

        return $redirect;
    }

    /**
     * @return \Vaimo\Mytest\Model\FunnyOrder
     */
    protected function getModel()
    {
        if ($this->orderModel === null) {
            return $this->orderFactory->create();
        } else {
            return $this->orderModel;
        }
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $this->_setPageData();

        return $this->resultPage;
    }
}
