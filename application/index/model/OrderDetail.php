<?php
/**
 * Created by PhpStorm.
 * User: @ 若雨
 * Date: 2018/8/14
 * Time: 13:28
 */

namespace app\index\model;


use think\Model;

class OrderDetail extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_order_detail';
    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d';
}