<?php
/**
 * 量具详情
 */

namespace app\index\model;

use think\Model;
class Metering extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_metering';
    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $dateFormat = 'Y-m-d';
}
