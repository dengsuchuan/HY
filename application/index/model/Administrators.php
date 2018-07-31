<?php
/**
 * 超级管理员数据模型
 * User: @ 若雨
 * Date: 2018/7/19
 * Time: 9:27
 */

namespace app\index\model;

use think\Model;
class  Administrators extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_administrators';
    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d';
}