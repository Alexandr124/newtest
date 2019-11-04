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


class FunnyOrder extends AbstractModel implements FunnyOrderInterface
{

    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getCreateOrder()
    {
        $this->getData(FunnyOrderInterface::FIELD_CREATE_ORDER);
    }

    public function getFunEnd()
    {
        $this->getData(FunnyOrderInterface::FIELD_FUN_END);
    }
    public function getFunStart()
    {
        $this->getData(FunnyOrderInterface::FIELD_FUN_START);
    }
    public function getPhone()
    {
        $this->getData(FunnyOrderInterface::FIELD_PHONE);
    }
    public function getStatus()
    {
        $this->getData(FunnyOrderInterface::FIELD_STATUS);
    }
    public function getWish()
    {
        $this->getData(FunnyOrderInterface::FIELD_WISH);
    }
    public function setCreateOrder($dataTime)
    {
        $this->setData(FunnyOrderInterface::FIELD_CREATE_ORDER,$dataTime);
    }
    public function setFunEnd($dataTime)
    {
        $this->setData(FunnyOrderInterface::FIELD_FUN_END,$dataTime);
    }
    public function setFunStart($dataTime)
    {
        $this->setData(FunnyOrderInterface::FIELD_FUN_START,$dataTime);
    }
    public function getId()
    {
        return $this->getData(FunnyOrderInterface::FIELD_ID);
    }
    public function setPhone($phone)
    {
        $this->setData(FunnyOrderInterface::FIELD_PHONE,$phone);
    }
    public function setStatus($bool)
    {
        $this->setData(FunnyOrderInterface::FIELD_STATUS,$bool);
    }
    public function setWish($text)
    {
       $this->setData(FunnyOrderInterface::FIELD_WISH,$text);
    }
}
