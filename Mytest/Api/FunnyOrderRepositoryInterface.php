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
    /**
     * @param $id
     *
     * @return mixed
     */
    public function getById($id);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return mixed
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param \Vaimo\Mytest\Model\FunnyOrderInterface $model
     *
     * @return mixed
     */
    public function save(\Vaimo\Mytest\Model\FunnyOrderInterface $model);

    /**
     * @param \Vaimo\Mytest\Model\FunnyOrderInterface $model
     *
     * @return mixed
     */
    public function delete(\Vaimo\Mytest\Model\FunnyOrderInterface $model);
}
