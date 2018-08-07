<?php
/**
 * Created by PhpStorm.
 * User: @ 若雨
 * Date: 2018/8/7
 * Time: 21:33
 */

namespace app\index\model;


use think\Model;
use catetree\Catetree;
class CostType extends Model
{
    protected $pk = 'id';
    protected $table = 'hy_cost_type';
    public static function getCostInfo(){
        $cate = new Catetree();
        return $cate->catetree(self::select());
    }
}