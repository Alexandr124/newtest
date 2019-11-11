<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-05
 * Time: 09:59
 */

namespace Vaimo\Mytest\Block\Buttons;

use Magento\Framework\Exception\NoSuchEntityException;
use Vaimo\Mytest\Api\FunnyOrderRepositoryInterface as Repository;

class GenericButton
{

    protected $request;
    protected $urlBuilder;
    protected $repository;


    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\UrlInterface $urlBuilder,
        Repository $repository
    ) {
        $this->request = $request;
        $this->repository = $repository;
        $this->urlBuilder = $urlBuilder;
    }


    public function getOrderId()
    {
        try {
            return $this->repository->getById(
                $this->request->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }

        return null;
    }


    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
