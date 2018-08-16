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