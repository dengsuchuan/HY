<?php
namespace app\index\model;

use think\Model;

class ComparnyP extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_company_number_p';

    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y年m月d日';
}