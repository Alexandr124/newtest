<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-10-18
 * Time: 10:15
 */

namespace Vaimo\Mytest\Block\Links;

use Magento\Framework\View\Element\Template;

/**
 * Class Mylinks
 * @package Vaimo\Mytest\Block\Links
 */
class Mylinks extends Template
{
    /**
     * @return array
     */
    public function getLinks()
    {
        $links[] = '/magento2/vaimo_mytest/testcontroller/index';
        $links[] = '/magento2/vaimo_mytest/secondtest/index';
        return $links;
    }
}
