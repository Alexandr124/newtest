<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-10-17
 * Time: 15:01
 */

namespace Vaimo\Mytest\Controller\Testcontroller;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;

class Index extends Action
{
    private $pageFactory;
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->prepend((__('My Page')));
        return $page;
    }
}