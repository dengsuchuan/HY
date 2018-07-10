<?php
namespace app\index\model;

use think\Model;

class Material extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_material';

    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y年m月d日';
}