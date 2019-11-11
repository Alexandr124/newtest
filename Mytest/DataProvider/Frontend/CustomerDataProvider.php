<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-11
 * Time: 13:52
 */

namespace Vaimo\Mytest\DataProvider\Frontend;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Vaimo\Mytest\Model\ResourceModel\FunnyOrder\CollectionFactory;
use Vaimo\Mytest\Model\FunnyOrderFactory;
use Magento\Customer\Model\SessionFactory;

class CustomerDataProvider extends AbstractDataProvider
{
    private $funnyOrderFactory;
    private $sessionFactory;

   public function __construct(SessionFactory $sessionFactory,
                               FunnyOrderFactory $funnyOrderFactory,
                               CollectionFactory $collectionFactory ,
                               $name,
                               $primaryFieldName,
                               $requestFieldName,
                               array $meta = [],
                               array $data = []
   ) {
       $this->sessionFactory    = $sessionFactory;
       $this->funnyOrderFactory = $funnyOrderFactory;
       $this->collection = $collectionFactory->create();
       parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
   }
   public function getData()
   {
       if ($this->sessionFactory->create()->getCustomer()->getDefaultShippingAddress()) {
           $phone = $this->sessionFactory->create()->getCustomer()->getDefaultShippingAddress()->getTelephone();
           $name  = $this->sessionFactory->create()->getCustomer()->getName();
           $model = $this->funnyOrderFactory->create();
           $model->setPhone($phone);
           $model->setHello($name.' chose please date and time');
           return [$model->getId() => $model->getData()];
       }
       return [0 =>['hello'=>'chose please date and time']];
   }
}