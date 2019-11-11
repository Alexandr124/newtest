<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-07
 * Time: 16:45
 */

namespace Vaimo\Mytest\Block\Buttons\Funnyorder;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Vaimo\Mytest\Block\Buttons\GenericButton;


class BackButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/*');
    }
}
