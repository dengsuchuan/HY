<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

use app\index\model\Client;
use app\index\model\MaterialShape;
use app\index\model\Section;
use app\index\model\BlueprintInfo;
use app\index\model\DrawingInternal;
use app\index\model\EquipmentType;
//use app\index\model\MeasuringType;
use app\index\model\CostType;
use app\index\model\BlueprintOutside;
use app\index\model\OrderDetail;
// 应用公共文件
//截取右边的展示内容
function msubstr($content) {
    return mb_substr(strip_tags(str_replace(['&nbsp;','nbsp;','&amp;','nbsp;'],'',$content)),0,450).'...';
}
function dd($value){
    dump($value);
    die;
}

function getClientName($id){
    $clientName = Client::where("id","$id")->value("client_abbreviation");
    $data = [
        'clientName'    =>  $clientName,
        'id'    => $id,
    ];
    return $data;
}

function getMateria($id){
    $clientName = MaterialShape::where("id","$id")->value("shape");
    return $clientName;
}

//材料形状的查询
function getWeight($id){//获取材料形状的重量
    $weight = Section::where("id","$id")->value("weight");
    return $weight;
}

function getWeightId($id){//获取材料形状的编号
    $weightId =  Section::where("id","$id")->value("spec");
    return $weightId;
}
function getCodet($id){
    $count = BlueprintInfo::where('drawing_internal_id','=',$id)->count();
    return$count;
}

//页数
function getInt($int){//4.2
    $int = $int > (int)$int?(int)$int+1:1;
    return $int;
}

//检查是否有子项    外图
function getDetialExternal($id){
    $count = BlueprintInfo::where('drawing_externa_id',$id)->count();
    return $count;
}

//检查是否有子项  组件
function getAssembly($id){
    $count = DrawingInternal::where('assembly_code',$id)->count();
    return $count;
}

//跟据id查询图纸明细编号
function getDrawingDetailId($id){
 return BlueprintInfo::where(['id'=>$id])->value('drawing_detail_id');
}

//跟据id获取客户简称
function getClientAbbreviation($id){
    return  $clientName = Client::where("id","$id")->value("client_abbreviation");
}

//获取设备名称
function getEquipmentName($id){
    return EquipmentType::where("id",$id)->value("eqpmt_type");
}

//获取量具名称
function getMeasuringName($id){
    return CostType::where("id",$id)->value("cost_name");
}
//获取外图ID
function getExternaId($code){
    return BlueprintOutside::where('drawing_external_id','=',$code)->value('id');
}
//获取外图编号
function getExternaCode($id){
    return BlueprintOutside::where('id','=',$id)->value('drawing_external_id');
}
//获取图纸明细编号
function getDrawingDetailCode($code){
    return BlueprintInfo::where(['drawing_externa_id'=>$code])->value('id');
}
function getCountExterna($id,$order_id){
//    return $id;
//
//    drawing_externa_or_internal_id
    $drawing_external_id = BlueprintOutside::where('id','=',$id)->value('drawing_external_id');
    $d_count = count(BlueprintInfo::where(['drawing_externa_id'=>$drawing_external_id])->select());
    $o_counrt = count(OrderDetail::where(['drawing_externa_or_internal_id'=>$id])->where('order_id','=',$order_id)->select());
    if($d_count > $o_counrt){
        return true;
    }else{
        return false;
    }
//    return $d_count.'--'.$o_counrt;
}

// 通过图纸明细ID 获取产品名称
function getDrawingName($id){
    return BlueprintInfo::where(['id'=>$id])->value('drawing_name');
}
function getblueprintInfoList($id){
    return (BlueprintInfo::where(['id'=>$id])->find());

}