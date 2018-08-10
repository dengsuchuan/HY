<?php
namespace app\index\model;

use think\Model;

class ComparnyM extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_company_number_m';

    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d';

}
