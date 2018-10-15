<?php
/**
 * Created by PhpStorm.
 * User: @ 若雨
 * Date: 2018/8/7
 * Time: 21:33
 */

namespace app\index\model;


use think\Model;
use catetree\Catetree;
class ProductionRecordsModel extends Model
{
    protected $pk = 'log_id';
    protected $table = 'hy_product_log';
    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d H:i:s';
}

