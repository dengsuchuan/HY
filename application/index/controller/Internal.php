<?php
/**
 * 内部图纸控制.
 * User: @ 若雨
 * Date: 2018/7/26
 * Time: 18:08
 */

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\DrawingInternal;
use app\index\model\ComparnyM;
class Internal extends Base
{
    //展示内部图纸列表
    public function internalInfo(){
        return $this->view->fetch('internal-info');
    }
    //添加内部图纸
    public function internalAdd(){
        //获取模装分类的信息
        $comparnyMInfo = ComparnyM::select();
        //获取数据库中M180706-x的数量实现自动生成编号
        $model = new DrawingInternal();//可实例化，也可不实例化
        $i = 0;//编号
        $str = "M".date('y').date('m').date('d')."-";//可以设置来之数据库的一个自定义字符串
        do{
            ++$i;  //第一次就为1，排除编号0
        }while($model->get(["drawing_Internal_id"=>$str.$i])); //如果存在就继续算下去

        $this->assign([
            "createId"  =>  $str.$i,
            'comparnyMInfo' =>$comparnyMInfo,
        ]);
        return $this->view->fetch('internal-add');
    }
}