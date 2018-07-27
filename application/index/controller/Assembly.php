<?php
/**
 * 组件图纸
 * User: @ 若雨
 * Date: 2018/7/27
 * Time: 11:57
 */

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\LloolingType;
use app\index\model\Assembly as AssemblyModel;
class Assembly extends Base
{
    public function assemblyInfo(){
        return $this->view->fetch('assembly-info');
    }
    public function assemblyAdd(){
        //获取工装类型
        $loolingInfo = LloolingType::order('sort asc')->select();
        $this->assign([
            'loolingInfo'  => $loolingInfo
        ]);
        //生成编号
        //获取数据库中M180706-x的数量实现自动生成编号
        $model = new AssemblyModel();//可实例化，也可不实例化
        $i = 0;//编号
        $str = "M".date('y').date('m').date('d')."-";//可以设置来之数据库的一个自定义字符串
        do{
            ++$i;  //第一次就为1，排除编号0
            if($i < 10){
                $i = '0'.$i;
            }
        }while($model->get(["assembly_code"=>$str.$i])); //如果存在就继续算下去
        $this->assign([
            "createId"  =>  $str.$i,]
        );
        return $this->view->fetch('assembly-add');

    }
}