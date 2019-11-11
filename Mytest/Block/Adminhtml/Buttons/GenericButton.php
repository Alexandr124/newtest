<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-05
 * Time: 09:59
 */

namespace Vaimo\Mytest\Block\Adminhtml\Buttons;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Vaimo\Mytest\Api\FunnyOrderRepositoryInterface as Repository;

class GenericButton
{
    /**
     * @var Context
     */
    protected $context;
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * GenericButton constructor.
     *
     * @param Context $context
     * @param Repository $repository
     */
    public function __construct(
        Context $context,
        Repository $repository
    ) {
        $this->context = $context;
        $this->repository = $repository;
    }

    /**
     * @return |null
     */
    public function getOrderId()
    {
        try {
            return $this->repository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }

        return null;
    }

    /**
     * @param string $route
     * @param array $params
     *
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
