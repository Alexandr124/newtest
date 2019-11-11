<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-01
 * Time: 18:37
 */

namespace Vaimo\Mytest\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Vaimo\Mytest\Model\FunnyOrderInterface;

/**
 * Class FunnyOrder
 * @package Vaimo\Mytest\Model\ResourceModel
 */
class FunnyOrder extends AbstractDb
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init(FunnyOrderInterface::TABLE_NAME, FunnyOrderInterface::FIELD_ID);
    }
}
