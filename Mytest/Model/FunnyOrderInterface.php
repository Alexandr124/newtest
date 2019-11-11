<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-04
 * Time: 08:55
 */

namespace Vaimo\Mytest\Model;

/**
 * Interface FunnyOrderInterface
 * @package Vaimo\Mytest\Model
 */
interface FunnyOrderInterface
{
    /**
     *
     */
    const TABLE_NAME          = 'funny_order';

    /**
     *
     */
    const FIELD_ID            = 'funny_id';
    /**
     *
     */
    const FIELD_CREATE_ORDER  = 'order_create';
    /**
     *
     */
    const FIELD_FUN_START     = 'fun_start';
    /**
     *
     */
    const FIELD_FUN_END       = 'fun_end';
    /**
     *
     */
    const FIELD_PHONE         = 'phone';
    /**
     *
     */
    const FIELD_WISH          = 'wish';
    /**
     *
     */
    const FIELD_STATUS        = 'status';
    /**
     *
     */
    const AVALIBLE_STATUS     = 1;

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param $dataTime
     *
     * @return mixed
     */
    public function setCreateOrder($dataTime);

    /**
     * @return mixed
     */
    public function getCreateOrder();

    /**
     * @param $dataTime
     *
     * @return mixed
     */
    public function setFunStart($dataTime);

    /**
     * @return mixed
     */
    public function getFunStart();

    /**
     * @param $dataTime
     *
     * @return mixed
     */
    public function setFunEnd($dataTime);

    /**
     * @return mixed
     */
    public function getFunEnd();

    /**
     * @param $phone
     *
     * @return mixed
     */
    public function setPhone($phone);

    /**
     * @return mixed
     */
    public function getPhone();

    /**
     * @param $text
     *
     * @return mixed
     */
    public function setWish($text);

    /**
     * @return mixed
     */
    public function getWish();

    /**
     * @param $bool
     *
     * @return mixed
     */
    public function setStatus($bool);

    /**
     * @return mixed
     */
    public function getStatus();
}
