<?php
/**
 * 订单模型
 * User: @ 若雨
 * Date: 2018/8/13
 * Time: 12:54
 */

namespace app\index\model;


use think\Model;

class Order extends  Model
{
    protected $pk = 'id';
    protected $table = 'hy_order';
    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d';
}