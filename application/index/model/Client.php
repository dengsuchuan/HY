<?php
/**
 * 组件图纸模型
 * User: @ 若雨
 * Date: 2018/7/19
 * Time: 9:27
 */

namespace app\index\model;

use think\Model;
class  Client extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_client';
    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d';
}
