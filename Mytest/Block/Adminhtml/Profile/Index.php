<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-10-16
 * Time: 11:37
 */

namespace Vaimo\Mytest\Block\Adminhtml\Profile;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Directory\Model\CountryFactory;

/**
 * Class Index
 * @package Vaimo\Mytest\Block\Adminhtml\Profile
 */
class Index extends Template
{
    const PASS_ARE_YOU_GLAD = 'vaimo_mytest2/mytest2/mytest_yes_no';
    const PASS_TEST_TEXT = 'vaimo_mytest/general/test_text';
    const PASS_TEST_COUNTRY = 'vaimo_mytest/general/test_country';
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var CountryFactory
     */
    private $countryFactory;

    /**
     * Index constructor.
     *
     * @param CountryFactory $countryFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param Context $context
     * @param array $data
     */
    public function __construct(CountryFactory $countryFactory, ScopeConfigInterface $scopeConfig, Context $context, array $data = [])
    {
        $this->countryFactory = $countryFactory;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    /**
     * @return mixed
     */
    public function getConfigAreYouGlad()
    {
        $yesNo = [
            'No',
            'Yes'
        ];

        return $yesNo[$this->scopeConfig->getValue($this::PASS_ARE_YOU_GLAD)];
    }

    /**
     * @return mixed
     */
    public function getConfigTestText()
    {
        return $this->scopeConfig->getValue($this::PASS_TEST_TEXT);
    }

    /**
     * @param $countryCode
     *
     * @return string
     */
    private function getCountryName($countryCode)
    {
        $country = $this->countryFactory->create()->loadByCode($countryCode);

        return $country->getName();
    }

    /**
     * @return array
     */
    public function getConfigCountries()
    {
        $countryCodes = explode(',', $this->scopeConfig->getValue($this::PASS_TEST_COUNTRY));
        $countryNames = array();
        foreach ($countryCodes as $countryCode) {
            $countryNames[] = $this->getCountryName($countryCode);
        }

        return $countryNames;
    }
}
