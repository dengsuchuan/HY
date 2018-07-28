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
use app\index\model\Assembly;
use think\facade\Request;
class Internal extends Base
{
    //展示内部图纸列表
    public function internalInfo(){
        $internalInfo = DrawingInternal::select();
        $this->assign([
            'internalInfo'  => $internalInfo
        ]);
        return $this->view->fetch('internal-info');
    }
    //添加内部图纸  内图
    public function internalAdd(){
        //获取数据库中P180706-x的数量实现自动生成编号
        $model = new DrawingInternal();//可实例化，也可不实例化
        $i = 0;//编号
        $str = "P".date('y').date('m').date('d')."-";//可以设置来之数据库的一个自定义字符串
        do{
            ++$i;  //第一次就为1，排除编号0
            if($i < 10){
                $i = '0'.$i;
            }
        }while($model->get(["drawing_Internal_id"=>$str.$i])); //如果存在就继续算下去

        //获取组件图纸信息
        $assemblyInfo  = Assembly::field('id,assembly_code')->select();
        $this->assign([
            "createId"      =>  $str.$i,
            'assemblyInfo'  =>  $assemblyInfo
        ]);
        return $this->view->fetch('internal-add');
    }
    //添加图纸
    public function internalAddAssembly(){
        $assemblyId = input('assembly_code');

        $assemblyCodeInfo = Assembly::where(['id'=>$assemblyId])->field('id,assembly_code')->find();
        $assemblyCode = $assemblyCodeInfo['assembly_code'];
        $assemblyCode_ = $assemblyCodeInfo['assembly_code'];
        $assembly_code = DrawingInternal::where(['assembly_code'=>$assemblyCode])->where(['is_assembly_code'=>1])->order('id desc')->field('id,drawing_Internal_id,assembly_code')->select();
        $cunot = count($assembly_code);
        if($cunot){
            $assembly_code = $assembly_code[0];
            $assembly_code =  intval(trim(strrchr($assembly_code['drawing_Internal_id'], '-'),'-'));
            $assembly_code = $assembly_code < 10 ?$assemblyCode_ .'-0' . ++ $assembly_code:$assemblyCode_.'-'.++ $assembly_code;
        }else{
            $assembly_code = $assemblyCode_.'-01';
        }
        $this->assign([
            'code' => $assembly_code,
        ]);
        return $this->view->fetch('internal-add-a');
    }

    //生成编号
    public function productionCode(){
        $assemblyId = Request::post();
        $assemblyId = intval($assemblyId['data']);
        $assemblyCodeInfo = Assembly::where(['id'=>$assemblyId])->field('id,assembly_code')->find();
        $assemblyCode = $assemblyCodeInfo['assembly_code'];
        $assemblyCode_ = $assemblyCodeInfo['assembly_code'];
        $assembly_code = DrawingInternal::where(['assembly_code'=>$assemblyCode])->where(['is_assembly_code'=>1])->order('id desc')->field('id,drawing_Internal_id,assembly_code')->select();
        $cunot = count($assembly_code);
        if($cunot){
            $assembly_code = $assembly_code[0];
            $assembly_code =  intval(trim(strrchr($assembly_code['drawing_Internal_id'], '-'),'-'));
            $assembly_code = $assembly_code < 10 ?$assemblyCode_ .'-0' . ++ $assembly_code:$assemblyCode_.'-'.++ $assembly_code;
            return json($assembly_code);

        }else{
            $assembly_code = $assemblyCode_.'-01';
            return json($assembly_code);
        }
    }
}