<?php
/**
 * 保养
 */

namespace app\index\model;

use think\Model;
class  Repair extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_repair';
    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $dateFormat = 'Y-m-d';
}
