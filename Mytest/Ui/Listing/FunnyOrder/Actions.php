<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-05
 * Time: 12:00
 */

namespace Vaimo\Mytest\Ui\Listing\FunnyOrder;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Class Actions
 * @package Vaimo\Mytest\Ui\Listing\FunnyOrder
 */
class Actions extends Column
{
    /**
     *
     */
    const URL_EDIT = 'vaimo_mytest/funnyorder/edit';
    const URL_DELETE = 'vaimo_mytest/funnyorder/delete';
    /**
     *
     */
    const IDENTIFIRE = 'funny_id';
    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * Actions constructor.
     *
     * @param UrlInterface $urlBuilder
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(UrlInterface $urlBuilder,
                                ContextInterface $context,
                                UiComponentFactory $uiComponentFactory,
                                array $components = [], array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $name = $this->getName();
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['funny_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl($this::URL_EDIT, ['id' => $item[$this::IDENTIFIRE]]),
                        'label' => __('Edit')
                    ];
                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl($this::URL_DELETE, ['id' => $item[$this::IDENTIFIRE]]),
                        'label' => __('Delete')
                    ];
                }
            }
        }

        return $dataSource;
    }
}
