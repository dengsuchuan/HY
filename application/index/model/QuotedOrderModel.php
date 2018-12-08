<?php
/**
 * 部门表数据模型
 * User: @ 若雨
 * Date: 2018/7/30
 * Time: 21:41
 */

namespace app\index\model;

use think\Model;

class QuotedOrderModel extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_quoted_order';
    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d';
}
