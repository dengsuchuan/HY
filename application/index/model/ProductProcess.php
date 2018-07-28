<?php
/**
 * 工艺表模型
 * User: SYSTEM
 * Date: 2018/7/11
 * Time: 23:43
 */

namespace app\index\model;


use think\Model;

class ProductProcess extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_product_process';
    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d';

}