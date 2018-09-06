<?php
/**
 * 订单报价
 */

namespace app\index\model;

use think\Model;
class  QuotedMode extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_quoted_price';
    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d';
}
