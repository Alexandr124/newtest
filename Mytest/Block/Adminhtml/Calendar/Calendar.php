<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-07
 * Time: 17:06
 */

namespace Vaimo\Mytest\Block\Adminhtml\Calendar;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Vaimo\Mytest\Model\FunnyOrderInterface;
use Vaimo\Mytest\Model\ResourceModel\FunnyOrder\CollectionFactory;

/**
 * Class Calendar
 * @package Vaimo\Mytest\Block\Adminhtml\Calendar
 */
class Calendar extends Template
{
    /**
     * @var CollectionFactory
     */
    private $funnyOrderCollectionFactory;

    /**
     * Calendar constructor.
     *
     * @param CollectionFactory $collectionFactory
     * @param Context $context
     * @param array $data
     */
    public function __construct(CollectionFactory $collectionFactory,
                                Context $context, array $data = [])
    {
        $this->funnyOrderCollectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getBusyDay()
    {
        $collection = $this->funnyOrderCollectionFactory->create();
        $collection->addFilter(FunnyOrderInterface::FIELD_STATUS, FunnyOrderInterface::AVALIBLE_STATUS, 'eq');
        $busyTime = array();
        $timeInterval = new \DateInterval('P1D');
        foreach ($collection->getItems() as $item) {
            $start = new \DateTime($item->getFunStart());
            $finish = (new \DateTime($item->getFunEnd()))->add($timeInterval);
            for (; $start <= $finish; $start = $start->add($timeInterval)) {
                $busyTime[] = $start->format('Y-m-d');
            }
        }

        return implode(",", $busyTime);
    }
}
