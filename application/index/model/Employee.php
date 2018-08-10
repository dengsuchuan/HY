<?php
/**
 * Created by PhpStorm.
 * User: @ 若雨
 * Date: 2018/7/30
 * Time: 22:33
 */

namespace app\index\model;


use think\Model;

class Employee extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_employee';

    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d';

}
