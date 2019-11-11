<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-01
 * Time: 18:24
 */

namespace Vaimo\Mytest\Model;

use Vaimo\Mytest\Model\ResourceModel\FunnyOrder as ResourceModel;
use Magento\Framework\Model\AbstractModel;

/**
 * Class FunnyOrder
 * @package Vaimo\Mytest\Model
 */
class FunnyOrder extends AbstractModel implements FunnyOrderInterface
{
    /**
     *
     */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @return mixed
     */
    public function getCreateOrder()
    {
        return $this->getData(FunnyOrderInterface::FIELD_CREATE_ORDER);
    }

    /**
     * @return mixed
     */
    public function getFunEnd()
    {
        return $this->getData(FunnyOrderInterface::FIELD_FUN_END);
    }

    /**
     * @return mixed
     */
    public function getFunStart()
    {
        return $this->getData(FunnyOrderInterface::FIELD_FUN_START);
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->getData(FunnyOrderInterface::FIELD_PHONE);
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->getData(FunnyOrderInterface::FIELD_STATUS);
    }

    /**
     * @return mixed
     */
    public function getWish()
    {
        return $this->getData(FunnyOrderInterface::FIELD_WISH);
    }

    /**
     * @param $dataTime
     */
    public function setCreateOrder($dataTime)
    {
        $this->setData(FunnyOrderInterface::FIELD_CREATE_ORDER, $dataTime);
    }

    /**
     * @param $dataTime
     */
    public function setFunEnd($dataTime)
    {
        $this->setData(FunnyOrderInterface::FIELD_FUN_END, $dataTime);
    }

    /**
     * @param $dataTime
     */
    public function setFunStart($dataTime)
    {
        $this->setData(FunnyOrderInterface::FIELD_FUN_START, $dataTime);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->getData(FunnyOrderInterface::FIELD_ID);
    }

    /**
     * @param $phone
     */
    public function setPhone($phone)
    {
        $this->setData(FunnyOrderInterface::FIELD_PHONE, $phone);
    }

    /**
     * @param $bool
     */
    public function setStatus($bool)
    {
        $this->setData(FunnyOrderInterface::FIELD_STATUS, $bool);
    }

    /**
     * @param $text
     */
    public function setWish($text)
    {
        $this->setData(FunnyOrderInterface::FIELD_WISH, $text);
    }
}
