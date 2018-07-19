<?php
/**
 * 工序类型模型
 * User: @ 若雨
 * Date: 2018/7/19
 * Time: 9:27
 */

namespace app\index\model;

use think\Model;
class ProcessType extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_process_type';
    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y年m月d日';
}