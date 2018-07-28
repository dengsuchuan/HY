<?php
/**
 * Created by PhpStorm.
 * User: 17424
 * Date: 2018/7/13
 * Time: 10:57
 */

namespace app\index\model;


use think\Model;

class DrawingInternal extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_drawing_Internal';

    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d';
}