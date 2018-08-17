<?php
/**
 * 设备详情
 */

namespace app\index\model;

use think\Model;
class  EquipmentInfo extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_equipment';
    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $dateFormat = 'Y-m-d';
}
