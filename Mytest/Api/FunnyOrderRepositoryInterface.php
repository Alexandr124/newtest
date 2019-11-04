<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-04
 * Time: 08:57
 */

namespace Vaimo\Mytest\Api;

interface FunnyOrderRepositoryInterface
{

    public function getById($id);


    public function deleteById($id);



    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);


    public function save(\Vaimo\Mytest\Model\FunnyOrderInterface $model);


    public function delete(\Vaimo\Mytest\Model\FunnyOrderInterface $model);
}