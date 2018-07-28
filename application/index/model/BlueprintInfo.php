<?php
namespace app\index\model;

use think\Model;

class BlueprintInfo extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_drawing_detial';

    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d';

}