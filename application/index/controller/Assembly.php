<?php
/**
 * 组件图纸
 * User: @ 若雨
 * Date: 2018/7/27
 * Time: 11:57
 */

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\BlueprintInfo;
use app\index\model\LloolingType;
use app\index\model\Assembly as AssemblyModel;
use app\index\model\ProductProcess;
use think\facade\Request;;
use app\index\model\DrawingInternal;
class Assembly extends Base
{

    protected $beforeActionList = [
        'isLogin',
    ];
    public function assemblyInfo($sort = 'asc'){
        if(Request::isPost()) {
            $data = Request::post();

            if($data['id']!="") {//这个ID是主键
//                $assemblyInfo = AssemblyModel::where("id", $data['id'])->paginate(25);
                $assemblyInfo = AssemblyModel::alias('a')->where("a.id", $data['id'])
                    ->order('assembly_code '.$sort.' ')
                    ->join('looling_type l','a.tooling_type = l.id')
                    ->field('a.*,l.looling_type_name')
                    ->paginate(25);
            }else{
                $assemblyInfo = AssemblyModel::alias('a')->where("a.assembly_code","LIKE","%".$data['modules']."%")
                    ->join('looling_type l','a.tooling_type = l.id')
                    ->order('a.assembly_code '.$sort.' ')
                    ->field('a.*,l.looling_type_name')
                    ->paginate(25);
            }
        }else{
            $assemblyInfo = AssemblyModel::alias('a')
                ->order('assembly_code '.$sort.' ')
                ->join('looling_type l','a.tooling_type = l.id')
                ->field('a.*,l.looling_type_name')
                ->paginate(25);
        }


        $assembluCount = count(AssemblyModel::field('id')->select());

        $this->assign([
            'assemblyInfo'   =>  $assemblyInfo,
            'assembluCount' => $assembluCount,
            'sort'          =>$sort
        ]);

        return $this->view->fetch('assembly-info');
    }
    //添加操作
    public function assemblyAdd(){
        if (Request::isAjax()){
            $data = Request::post();
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
            $data['assembly_code'] = $str.$i;
            $maxSort = AssemblyModel::order('sort desc')->value('sort');
            $data['sort'] = ++$maxSort;
            $data['create_name'] = session('user.user_name');
            $info = AssemblyModel::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }

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
    public function assemblyEdit(){
        if(Request::isAjax()){
            $data = Request::post();
            $id = $data['id'];
            unset($data['id']);
            $data['modify_name'] = session('user.user_name');

            $info = AssemblyModel::update($data,['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $id = intval(input('id'));
        $assemblyRow = AssemblyModel::where(['id'=>$id])->find();
        //获取工装类型
        $loolingInfo = LloolingType::order('sort asc')->select();
        $this->assign([
            'loolingInfo'  => $loolingInfo,
            'assemblyRow'  => $assemblyRow
        ]);
        return $this->view->fetch('assembly-edit');
    }
    //删除
    public function delete(){
        $id = intval(input('id'));
        $assembly_code = AssemblyModel::where(['id'=>$id])->value('assembly_code');  //获取编号
        //获取内图
        $drawingInternalInfo = DrawingInternal::where(['assembly_code'=>$assembly_code])->field('drawing_Internal_id')->select();
        //获取内图下面的图纸明细
        foreach ($drawingInternalInfo as $item){
            $info = BlueprintInfo::where(['drawing_internal_id'=>$item['drawing_Internal_id']])->field('drawing_detail_id')->select();  //获取到的图纸明细
            //通过图纸明细获取下面的工序
            foreach ($info as $item1){
                $info1 = ProductProcess::where(['drawing_detial_id'=>$item1['drawing_detail_id']])->delete();  //删除对应的工序
            }
        }
        foreach ($drawingInternalInfo as $item){
            $info = BlueprintInfo::where(['drawing_internal_id'=>$item['drawing_Internal_id']])->delete();  //删除对应的图纸明细
        }
        $info = AssemblyModel::where(['id'=>intval(input('id'))])->delete();
        if($info){
            DrawingInternal::where(['assembly_code'=>$assembly_code])->delete();
            return json(1);
        }else{
            return json(0);
        }
    }
    //批量删除
    public function delAll()
    {
        $data = input();
        $ids = $data['data'];
        $inf = false;
        foreach ($ids as $id) {
            $info = AssemblyModel::where(['id' => $id])->delete();
            if ($info) {
                $inf = true;
            }
        }
        if($inf){
            return json(1);
        }else{
            return json(0);
        }
    }
    public function SanSort(){
        $data = Request::post();
        $AssemblyModel = new AssemblyModel();
        return $this->Sort($data,$AssemblyModel);
    }
}