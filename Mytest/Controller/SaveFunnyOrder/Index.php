<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-11
 * Time: 11:37
 */

namespace Vaimo\Mytest\Controller\SaveFunnyOrder;

use Magento\Framework\App\Action\Action;
class Index extends Action
{
    public function execute()
    {
        $m = $this->getRequest()->getParams();
        return 0;
    }
}