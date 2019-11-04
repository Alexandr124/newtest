<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-01
 * Time: 18:44
 */

namespace Vaimo\Mytest\Model\ResourceModel\FunnyOrder;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(\Vaimo\Mytest\Model\FunnyOrder::class, \Vaimo\Mytest\Model\ResourceModel\FunnyOrder::class);
    }
}