<?php
/**
 * 工艺表模型
 * User: SYSTEM
 * Date: 2018/7/11
 * Time: 23:43
 */

namespace app\index\model;


use think\Model;

class ProductLog extends Model
{
    protected $pk = 'log_id';
    protected $table = 'hy_product_log';
    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d H:i:s';

}
