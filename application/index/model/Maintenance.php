<?php
/**
 * 保养
 */

namespace app\index\model;

use think\Model;
class  Maintenance extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_maintenance';
    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $dateFormat = 'Y-m-d';
}
