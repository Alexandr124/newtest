<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-04
 * Time: 08:55
 */

namespace Vaimo\Mytest\Model;

interface FunnyOrderInterface
{
    const TABLE_NAME          = 'funny_order';
    const FIELD_ID            = 'funny_id';
    const FIELD_CREATE_ORDER  = 'order_create';
    const FIELD_FUN_START     = 'fun_start';
    const FIELD_FUN_END       = 'fun_end';
    const FIELD_PHONE         = 'phone';
    const FIELD_WISH          = 'wish';
    const FIELD_STATUS        = 'status';

    public function getId();

    public function setCreateOrder($dataTime);
    public function getCreateOrder();

    public function setFunStart($dataTime);
    public function getFunStart();

    public function setFunEnd($dataTime);
    public function getFunEnd();

    public function setPhone($phone);
    public function getPhone();

    public function setWish($text);
    public function getWish();

    public function setStatus($bool);
    public function getStatus();
}
