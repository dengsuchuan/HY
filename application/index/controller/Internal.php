<?php
/**
 * 内部图纸控制.
 * User: @ 若雨
 * Date: 2018/7/26
 * Time: 18:08
 */

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\BlueprintInfo;
use app\index\model\DrawingInternal;
use app\index\model\Assembly;
use think\facade\Request;
use app\index\model\Material;
use app\index\model\MaterialShape;
use app\index\model\Client;
use app\index\model\Section;
class Internal extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
    //展示内部图纸列表
    public function internalInfo($sort = 'asc'){
        if(Request::isPost()){
            $data = Request::post();
            if($data['id']!=""){//这个ID是主键
                $internalInfo = DrawingInternal::where('id',$data['id'])->order('sort '.$sort.' ')->paginate(25);
            }else{
                $internalInfo = DrawingInternal::order('create_time', 'desc')
                    ->where("drawing_Internal_id","LIKE","%".$data['modules']."%")
                    ->paginate(25);
            }
            $internalCode = DrawingInternal::field('drawing_Internal_id,id')->select();
            $countInternalInfo = $internalInfo->total();
            $this->assign("countInternalInfo",$countInternalInfo);
            $this->assign([
                'internalInfo'  => $internalInfo,
                'sort'          =>$sort,
                'internalCode'  =>  $internalCode,
                'code'          =>  'N'
            ]);
            return $this->view->fetch('internal-info');
        }

        $assembly_code = input('assembly_code');
        $code = input('code');
        if(isset($assembly_code)){
            $internalInfo = DrawingInternal::where('assembly_code',$assembly_code)->order('sort '.$sort.' ')->paginate(25);
            $internalCode = DrawingInternal::field('drawing_Internal_id,id')->select();
            $this->assign([
                'internalInfo'  => $internalInfo,
                'sort'          =>$sort,
                'internalCode'  =>  $internalCode,
                'code'          =>  'N'

            ]);
            $countInternalInfo = $internalInfo->total();
            $this->assign("countInternalInfo",$countInternalInfo);
            return $this->view->fetch('internal-info');
        }
        if($code == 'M'){
            $internalInfo = DrawingInternal::order('drawing_Internal_id '.$sort.' ')->paginate(25);
            $internalCode = DrawingInternal::field('drawing_Internal_id,id')->select();
            $this->assign([
                'internalInfo'  => $internalInfo,
                'sort'          =>$sort,
                'internalCode'  =>  $internalCode,
                'code'          =>  'M'
            ]);
            $countInternalInfo = $internalInfo->total();
            $this->assign("countInternalInfo",$countInternalInfo);
            return $this->view->fetch('internal-info');
        }
        $internalInfo = DrawingInternal::order('drawing_Internal_id '.$sort.' ')->where('assembly_code','=','')->paginate(25);
        $internalCode = DrawingInternal::field('drawing_Internal_id,id')->select();
        $this->assign([
            'internalInfo'  => $internalInfo,
            'sort'          =>$sort,
            'internalCode'  =>  $internalCode,
            'code'          =>  ''
        ]);
        $countInternalInfo = $internalInfo->total();
        $this->assign("countInternalInfo",$countInternalInfo);
        return $this->view->fetch('internal-info');
    }
    //添加内部图纸  内图
    public function internalAdd(){
        if(Request::isAjax()){
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


            $data = Request::post();
            $data['drawing_Internal_id'] = $str.$i;
            $data['create_name'] = session('user.user_name');
            $info = DrawingInternal::create($data);
            if($info){
                if($info){
                    return json(1);
                }else{
                    return json(0);
                }
            }
        }

        //获取数据库中P180706-x的数量实现自动生成编号
        $str = "P".date('y').date('m').date('d');
        $model = new DrawingInternal();
        $newId = $this->getNewId($str,$model,"drawing_Internal_id");

        //获取组件图纸信息
        $assemblyInfo  = Assembly::field('id,assembly_code')->select();
        $this->assign([
            "createId"      =>  $newId,
            'assemblyInfo'  =>  $assemblyInfo
        ]);
        return $this->view->fetch('internal-add');
    }
    //添加图纸
    public function internalAddAssembly(){
        if(Request::isAjax()){
            $data = Request::post();
            $data['is_assembly_code'] = 1;
            $assemblyId = $data['assemblyId'];
            unset($data['assemblyId']);
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
            $data['drawing_Internal_id'] = $assembly_code;
            $data['create_name'] = session('user.user_name');
            $info = DrawingInternal::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
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
            'assemblyCode_'    => $assemblyCode_,
            'assemblyId'       =>   $assemblyId
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
    public function SanSort(){
        $data = Request::post();
        $DrawingInternal = new DrawingInternal();
        return $this->Sort($data,$DrawingInternal);
    }
    public function edit(){
        if(Request::isAjax()){
            $data = Request::post();
            $id = $data['id'];
            $data['modify_name'] = session('user.user_name');
            $info = DrawingInternal::update($data,['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $id = intval(input('id'));
        $internal = DrawingInternal::get($id);
        $assemblyInfo = Assembly::select();
        $this->assign([
           'internal'  =>  $internal,
            'assemblyInfo'  =>  $assemblyInfo,
        ]);
        return $this->view->fetch('internal-edit');
    }
    public function delete(){
        $info = DrawingInternal::where(['id'=>intval(input('id'))])->delete();
        if($info){
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
        foreach ($ids as $id) {
            $info = DrawingInternal::where(['id' => $id])->delete();
        }
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
    public function internalBelonged($sort = 'desc'){
        $assembly_code = input('assembly_code');
        $internal_belonged = DrawingInternal::where('assembly_code',$assembly_code)->order('sort '.$sort.' ')->paginate(25);
        $this->assign([
            'internal_belonged'    =>  $internal_belonged,
            'sort'  =>$sort
        ]);
        return $this->view->fetch('internal-info-belonged');
    }

    //添加明细视图
    public function addDetial(){
        $internal = input();//获得内图编号

        //更新一下最新的明细编号
        $str = $internal['id'];
        $model = new BlueprintInfo();
        $newId = $this->getNewId($str,$model,'drawing_detail_id');

        $this->assign("internal",$internal['id']);
        $this->assign("newDetial",$newId);

        //------这里开始复制代码-------------------------------
        $detailArray = array();
        /*------------------生成新的--明细编号------------------------*/
        $material = Material::all();//获取所有材料

        $detailArray = [
            'drawing_detail_id'=>$newId,//图纸明细的编号
            'material'=>$material,//获取所有材料
        ];
        $this->assign("detailArray",$detailArray);
        /*----------------材料形状处理----------------------*/
        $materialShape = MaterialShape::all();
        $this->assign("materialShapeArray",$materialShape);

        $client = Client::all();//所有客户
        $this->assign("client",$client);

        $section = Section::all();//材料规格
        $this->assign("section",$section);




        return $this->view->fetch("add-drawing-detial");
    }

    //添加图纸明细写入
    public function createDetial(){
        if(Request::isAjax()) {
            $jsontext = Request::post("json");
            $jsonToArray = json_decode($jsontext, true);
            $arrayToJson = json_encode($jsonToArray);
            $jsonToArray = json_decode($arrayToJson, true);
            //更新一下最新的明细编号
            $str = $jsonToArray['drawing_internal_id'];
            $model = new BlueprintInfo();
            $newId = $this->getNewId($str, $model, 'drawing_detail_id');
            $jsonToArray['drawing_detail_id'] = $newId;
            //写入创建者
            $jsonToArray['create_name'] = session('user.user_name');
            if (session('user.is_price') == 0) {
                $jsonToArray['product_mfg_cost'] = 0;
                $jsonToArray['product_quotation'] = 0;
                $jsonToArray['product_real_price'] = 0;
            } else if (session('user.is_price') == 1) {
                $jsonToArray['product_mfg_cost'] = 0;
                $jsonToArray['product_quotation'] = 0;
                $jsonToArray['product_real_price'] = 0;
            }
            //var_dump($jsonToArray);
            $info = BlueprintInfo::create($jsonToArray);//创建明细
            if ($info) {
                return json(1);
            } else {
                return json(0);
            }
        }
    }

}